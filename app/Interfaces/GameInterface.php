<?php
/**
 * Created by PhpStorm.
 * User: rohit
 * Date: 2/3/18
 * Time: 12:27 AM
 */

namespace App\Interfaces;

interface GameInterface
{

    public function setMatches();

    public function getMatches();

    public function startGame();

    public function playGame($teamArray);
}