<?php

namespace App\Http\Controllers;

use App\Teams;
use App\Interfaces\TeamInterface;

class TeamsController extends Controller
{

    protected $teamRepo;

    /**
     * GroupsController constructor.
     *
     * @param App /Repositories/TeamRepository $teamRepo
     *            perform Dependency Injection to a Interface which is implemented by a Repo
     *            Dependency injection also allow to typeCast the @param
     *            Following Repository pattern
     * @author Rohit N
     */
    public function __construct(TeamInterface $teamRepo)
    {
        $this->teamRepo = $teamRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teams');
    }

    /**
     * Display the specified resource.
     *
     * @param  $teamId
     * @return \Illuminate\Http\Response
     */
    public function show($teamId)
    {
        return $this->teamRepo->getTeamDetailsWithPlayers($teamId);
    }

    /**
     * @param $teamAId
     * @param $teamBId
     * @return mixed
     */
    public function getPlayers($teamAId, $teamBId)
    {
        return $this->teamRepo->getPlayers($teamAId, $teamBId);
    }

    /**
     * @return mixed
     */
    public function getTopPlayersView()
    {
        return view('topPlayers');
    }

    /**
     *fet the top playes on basis of their point
     */
    public function getTopPlayers()
    {
        return $this->teamRepo->getTopPlayers();
    }

    public function teamRankingView()
    {
        return view('topTeams');
    }

    /**
     * get the top teams on the basis of their score chart
     */
    public function getTopTeams()
    {
        return $this->teamRepo->getTopTeams();

    }
}
