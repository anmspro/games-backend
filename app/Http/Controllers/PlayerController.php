<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::all();

        return \response()->json($players);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $player = Player::create($request->all());

        if($player) {
            return \response()->json("success");
        }
        else {
            return \response()->json("failed");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        $player = Player::find($player->id);

        if($player) {
            return \response()->json($player);
        }
        else {
            return \response()->json("failed");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $player = Player::find($player->id);
        $player->update($request->all());

        if($player) {
            return \response()->json($player);
        }
        else {
            return \response()->json("failed");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $player = Player::find($player->id);
        $player->delete();

        if($player) {
            return \response()->json("success");
        }
        else {
            return \response()->json("failed");
        }
    }
}
