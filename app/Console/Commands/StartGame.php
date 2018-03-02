<?php

namespace App\Console\Commands;

use App\Interfaces\GameInterface;
use App\Models\Game;
use App\Models\Scores;
use App\Models\Teams;
use Illuminate\Console\Command;

class StartGame extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:game';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts NBA game';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param GameInterface $game
     * @return mixed
     */
    public function handle(GameInterface $game)
    {
        $teamArray = $this->beforeGamePreRequest($game);
        $updateCount = 1;
        // 120 because i am giving sleep of 2 seconds
        // that means if all matches are gonna finish in 240 seconds than
        // this loop must ends within 240/2 that is 120 times
        $totalUpdateCount = 120;
        while ($updateCount <= $totalUpdateCount) {
            $game->playGame($teamArray);
            $updateCount++;
            sleep(2);
        }
        if ($updateCount >= 120) {
            $game->UpdateTeamsScore();
        }
    }

    /**
     * @return array
     * array of team id so that we can
     * easily assigned scores
     */
    private function getTeamIdsArray()
    {
        $teams = Teams::select('id')->get();
        $teamArray = [];
        foreach ($teams as $team) {
            $teamArray[] = $team->id;
        }

        return $teamArray;
    }

    /**
     * this is done as we are not require history
     * every time we start a game random teams
     * random scores will assigned as a result every time
     * new matches will played but the teams points also get updated
     * as per match scores
     */
    private function truncateIfScoresExist()
    {
        if (Scores::all()->count() >= 1) {
            Scores::Truncate();
        }
    }

    public function truncateGamesIfExist()
    {
        if (Game::all()->count() >= 1) {
            Game::Truncate();
        }
    }

    /**
     * @param GameInterface $game
     * @return array
     */
    private function beforeGamePreRequest(GameInterface $game)
    {
        $teamArray = $this->getTeamIdsArray();
        $this->truncateIfScoresExist();
        $this->truncateGamesIfExist();
        $game->setMatches();

        return $teamArray;
    }
}
