<?php

namespace App\Console\Commands;

use App\Interfaces\GameInterface;
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
        $teams = Teams::select('id')->get();
        $teamArray = $this->getTeamIdsArray($teams);
        $updateCount = 1;
        // 120 because i am giving sleep of 2 seconds
        // that means if all matches are gonna finish in 240 seconds than
        // this loop must ends within 240/2 that is 120 times
        $totalUpdateCount = 120;
        while ($updateCount <= $totalUpdateCount) {
            $game->playGame($teamArray  );
            $updateCount++;
            sleep(2);
        }
    }

    /**
     * @param $teams
     * @return array
     */
    private function getTeamIdsArray($teams)
    {
        $teamArray = [];
        foreach ($teams as $team) {
            $teamArray[] = $team->id;
        }

        return $teamArray;
    }
}
