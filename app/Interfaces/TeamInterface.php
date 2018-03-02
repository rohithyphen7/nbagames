<?php
/**
 * Created by PhpStorm.
 * User: rohit
 * Date: 2/3/18
 * Time: 12:44 AM
 */

namespace App\Interfaces;


interface TeamInterface
{

    public function getTeamDetailsWithPlayers($teamId);

    public function getPlayers($teamAId,$teamBId);

    public function getPlayingPlayers($teamId);

    public function getTopPlayers();

    public function getTopTeams();
}