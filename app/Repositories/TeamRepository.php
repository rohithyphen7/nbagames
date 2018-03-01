<?php

namespace App\Repositories;

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

    public function getTeamDetailsWithPlayers($teamId)
    {
        return Teams::find($teamId)->with([
            'players' => function ($query) {
                $query->orderBy('points', 'desc');
            }
        ])->first();
    }

    public function getPlayers($teamAId,$teamBId)
    {
        $teamA = $this->getPlayingPlayers($teamAId);
        $teamB = $this->getPlayingPlayers($teamBId);
        return ['teamA'=>$teamA,'teamB'=>$teamB];
    }

    public function getPlayingPlayers($teamId)
    {
        return Teams::with([
            'players' => function ($query) {
                $query->orderBy('players.points', 'desc')->take(5);
            }
        ])->where('teams.id', $teamId)->first();
    }
}