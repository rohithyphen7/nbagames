<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\GameInterface;

class GameController extends Controller
{

    protected $gameRepo;

    /**
     * GameController constructor.
     *
     * @param GameInterface $gameRepo
     * perform Dependency Injection to a Interface which is implemented by repo
     * Dependency injection also allow to typeCast the @param
     * Following Repository pattern
     */
    public function __construct(GameInterface $gameRepo)
    {
        $this->gameRepo = $gameRepo;
    }

    /**
     *get all matches
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->gameRepo->getMatches();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->gameRepo->startGame();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Game                $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }

    /**
     *set the matches between two teams
     * @return \Illuminate\Http\Response
     */
    public function setMatches()
    {
        return $this->gameRepo->setMatches();
    }
}
