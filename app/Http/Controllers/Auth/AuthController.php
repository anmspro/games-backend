<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);
    //     if ($validator->fails()) {
    //         return response(['errors' => $validator->errors()->all()], 422);
    //     }
    //     $request['password'] = Hash::make($request['password']);
    //     $request['remember_token'] = Str::random(10);
    //     $user = User::create($request->toArray());
    //     $token = $user->createToken('Laravel Password Grant Client')->accessToken;
    //     $response = ['token' => $token];
    //     return response($response, 200);
    // }

    // function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|email|max:255',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);
    //     if ($validator->fails()) {
    //         return response(['errors' => $validator->errors()->all()], 422);
    //     }
    //     $user = User::where('email', $request->email)->first();
    //     if ($user) {
    //         if (Hash::check($request->password, $user->password)) {
    //             $token = $user->createToken('Laravel Password Grant Client')->accessToken;
    //             $response = ['token' => $token];
    //             return response($response, 200);
    //         } else {
    //             $response = ["message" => "Password mismatch"];
    //             return response($response, 422);
    //         }
    //     } else {
    //         $response = ["message" => 'User does not exist'];
    //         return response($response, 422);
    //     }
    // }

    // public function logout(Request $request)
    // {
    //     $token = $request->user()->token();
    //     $token->revoke();
    //     $response = ['message' => 'You have been successfully logged out!'];
    //     return response($response, 200);
    // }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully loggedin');
        }

        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
