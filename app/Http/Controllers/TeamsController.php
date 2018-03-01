<?php

namespace App\Http\Controllers;

use App\Teams;
use Illuminate\Http\Request;
use App\Interfaces\TeamInterface;

class TeamsController extends Controller
{

    protected $teamRepo;

    /**
     * GroupsController constructor.
     *
     * @param App /Repositories/TeamRepository $teamRepo
     * perform Dependency Injection to a Interface which is implemented by a Repo
     * Dependency injection also allow to typeCast the @param
     * Following Repository pattern
     * @author Rohit N
     */
    public function __construct(TeamInterface $teamRepo)
    {
        $this->teamRepo = $teamRepo;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
     * @param  $teamId
     * @return \Illuminate\Http\Response
     */
    public function show($teamId)
    {
        return $this->teamRepo->getTeamDetailsWithPlayers($teamId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teams $teams
     * @return \Illuminate\Http\Response
     */
    public function edit(Teams $teams)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Teams               $teams
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teams $teams)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teams $teams
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teams $teams)
    {
        //
    }

    public function getPlayers($teamAId,$teamBId)
    {
        return $this->teamRepo->getPlayers($teamAId,$teamBId);
    }
}
