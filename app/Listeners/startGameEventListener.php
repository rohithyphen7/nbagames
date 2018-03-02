<?php

namespace App\Listeners;

use App\Events\startGameEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Scores;
use App\Models\Teams;

class startGameEventListener implements ShouldQueue
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  startGameEvent $event
     * this is the core function that creates an illusion that
     * match is going on but it is yet not in use as
     * we are satrating match through php atisan cammand
     * @return void
     */
    public function handle(startGameEvent $event)
    {
        if (Scores::all()->count() >= 1) {
            Scores::Truncate();
        }
        $teams = Teams::select('id')->get();
        $teamArray = $this->getTeamIdsArray($teams);
        $updateCount = 1;
        // 120 because i am giving sleep of 2 seconds
        // that means if all matches are gonna finish in 240 seconds than
        // this loop must ends within 240/2 that is 120 times
        $totalUpdateCount = 120;
        for ($i =$updateCount;$i<= $totalUpdateCount;$i++) {
            $this->playGame($teamArray);
            $updateCount++;
            sleep(2);
        }
        retrun ["ok"];
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

    /**
     * @param $teamArray
     */
    public function playGame($teamArray)
    {
        $data = [
            'team_id'      => $teamArray[ array_rand($teamArray, 1) ],
            'score'        => rand(1, 3),
            'attack_count' => rand(1, 4),
            'assist'       => rand(1, 5),
            'success_rate' => rand(1, 2)
        ];

        Scores::insert($data);
    }
}
