<?php
/**
 * Created by PhpStorm.
 * User: rohit
 * Date: 1/3/18
 * Time: 4:45 PM
 */

namespace App\Repositories;

use App\Events\startGameEvent;
use App\Models\Game;
use App\Models\Teams;
use App\Models\Scores;
use App\Interfaces\GameInterface;

class GameRepository implements GameInterface
{

    /**
     * random teams are set against each other in this function
     * i use unset in order to get unique teams in every single iteration
     *
     * @author Rohit N.
     */
    public function setMatches()
    {
        $teams = Teams::All()->toArray();
        $teamArray = $teams;
        // foreach so that iteration will e equals to the numbers of teams
        // can also use for loop but foreach is more readable
        if (Game::all()->count() >= 1) {
            return view('game');
        } else {
            foreach ($teams as $team) {
                if ( !empty($teamArray)) {
                    list($randomTeamKey, $teamA, $teamB) = $this->setRandomTeams($teamArray);
                    unset($teamArray[ $randomTeamKey[ 0 ] ]);
                    unset($teamArray[ $randomTeamKey[ 1 ] ]);
                    Game::insert(['teamA_id' => $teamA, 'teamB_id' => $teamB]);
                }

            }

            return view('game');
        }


    }

    /**
     * @param $teamArray
     * @return array
     * using array_rand function
     * it return 2 values and after getting keys from array_rand function
     * i set two teams and return both the teams with the value
     * coming from array_rand function so that i can unset it from main array
     * @author Rohit N.
     */
    private function setRandomTeams(Array $teamArray): array
    {
        $randomTeamKey = array_rand($teamArray, 2);
        $teamA = $teamArray[ $randomTeamKey[ 0 ] ][ 'id' ];
        $teamB = $teamArray[ $randomTeamKey[ 1 ] ][ 'id' ];

        return array($randomTeamKey, $teamA, $teamB);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * It return both teams that are competing with each other
     */
    public function getMatches()
    {
        return Game::with('teamA')->with('teamB')
                   ->with([
                       'scoreOfTeamA' => function ($query) {
                           $query->selectRaw("SUM(score) as score,SUM(attack_count) as attack_count,SUM(assist) as assist,
                                    SUM(success_rate) as success_rate,team_id")->groupBy('team_id')->get();
                       }
                   ])->with([
                'scoreOfTeamB' => function ($query) {
                    $query->selectRaw("SUM(score) as score,SUM(attack_count) as attack_count,SUM(assist) as assist,
                            SUM(success_rate) as success_rate,team_id")->groupBy('team_id')->get();
                }
            ])->get();
    }

    /**
     * its a trigger which start filling the score board
     * keeping it hidden for the moment as the match will
     * start with a camand line
     * through a php artisan cammand
     * php artisan start:match
     */
    public function startGame()
    {
        event(new startGameEvent());
    }

    /**
     * @param $teamArray
     * insert random data in score table in order to
     * keep an illusion that match is going on
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

    public function UpdateTeamsScore()
    {
        $scoreArray = $this->makeScoreTeamArray();
        $games = Game::all();
        foreach ($games as $game) {
            if ( !empty($scoreArray[ $game->teamA_id ]) and !empty($scoreArray[ $game->teamB_id ])) {
                if ($scoreArray[ $game->teamA_id ] > $scoreArray[ $game->teamB_id ]) {
                    $winningTeam = Teams::find($game->teamA_id);
                    $loosingTeam = Teams::find($game->teamB_id);
                    $winningTeamId = $game->teamA_id;
                    $loosingTeamId = $game->teamB_id;
                    $this->updateTeamsPointTable($winningTeam,
                        $loosingTeam, $winningTeamId, $loosingTeamId);

                } else {
                    $winningTeam = Teams::find($game->teamB_id);
                    $loosingTeam = Teams::find($game->teamA_id);
                    $winningTeamId = $game->teamB_id;
                    $loosingTeamId = $game->teamA_id;
                    $this->updateTeamsPointTable($winningTeam,
                        $loosingTeam, $winningTeamId, $loosingTeamId);
                }
            }
        }
    }

    /**
     * @return array
     * nake array of key as team_id and sum of score as value
     * so that comparison between two teas will be easy.
     */
    private function makeScoreTeamArray()
    {
        $scoreArray = [];
        $scores = Scores::selectRaw('sum(score) as score,team_id')->groupBy('team_id')->get();
        foreach ($scores as $score) {
            $scoreArray[ $score->team_id ] = $score->score;
        }

        return $scoreArray;
    }

    /**
     * @param $winningTeam
     * @param $loosingTeam
     * @param $winningTeamId
     * @param $loosingTeamId
     * @return array
     */
    private function updateTeamsPointTable($winningTeam, $loosingTeam, $winningTeamId, $loosingTeamId)
    {
        $updateDataArray = [
            'total_matches' => $winningTeam->total_matches + 1,
            'win'           => $winningTeam->win + 1,
            'points'        => $winningTeam->points + 2
        ];
        $updateDataArrayLoosing = [
            'total_matches' => $loosingTeam->total_matches + 1,
            'loose'         => $loosingTeam->loose + 1
        ];
        Teams::where('id', $winningTeamId)->update($updateDataArray);
        Teams::where('id', $loosingTeamId)->update($updateDataArrayLoosing);
    }
}