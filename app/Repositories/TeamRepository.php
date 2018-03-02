<?php

namespace App\Repositories;

use App\Models\Players;
use App\Models\Teams;
use App\Interfaces\TeamInterface;
/**
 * Created by PhpStorm.
 * User: rohit
 * Date: 1/3/18
 * Time: 3:25 PM
 */
class TeamRepository implements TeamInterface
{

    /**
     * @param $teamId
     * @return mixed
     * get players and teams on base of team id
     */
    public function getTeamDetailsWithPlayers($teamId)
    {
        return Teams::find($teamId)->with([
            'players' => function ($query) {
                $query->orderBy('points', 'desc');
            }
        ])->first();
    }

    /**
     * @param $teamAId
     * @param $teamBId
     * @return array
     * getting two teams data as per the listing of ongoing matches
     */
    public function getPlayers($teamAId,$teamBId)
    {
        $teamA = $this->getPlayingPlayers($teamAId);
        $teamB = $this->getPlayingPlayers($teamBId);
        return ['teamA'=>$teamA,'teamB'=>$teamB];
    }

    /**
     * @param $teamId
     * relation ship between teams and players are feteched
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function getPlayingPlayers($teamId)
    {
        return Teams::with([
            'players' => function ($query) {
                $query->orderBy('players.points', 'desc')->take(5);
            }
        ])->where('teams.id', $teamId)->first();
    }

    /**
     * to get the top 20 players
     * @return mixed
     */
    public function getTopPlayers()
    {
         return Players::orderBy('points')->take(20)->get();
    }
}