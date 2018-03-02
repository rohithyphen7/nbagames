<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
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
     *set the matches between two teams
     *
     * @return \Illuminate\Http\Response
     */
    public function setMatches()
    {
        return $this->gameRepo->setMatches();
    }
}
