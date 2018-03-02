<?php

use Illuminate\Database\Seeder;
use App\Models\Teams;
use Carbon\Carbon;
use Faker\Factory as Faker;

class TeamsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        if (Teams::all()->count() >= 1) {
            Teams::truncate();
        }
        //teams are coming from config file
        $teams = collect(config('nba_config.teams'));
        if ( !empty($teams)) {
            $teams->each(function ($groupId, $teamName) use($faker) {
                $win = $faker->numberBetween(1, 50);
                $loose = $faker->numberBetween(1, 50);
                $draw = $faker->numberBetween(0, 5);
                $totalMatches = $win + $loose + $draw;
                $points = 2 * $win;
                $splitArray = explode(' ',trim($teamName));
                Teams::insert([
                    'name'       => $teamName,
                    'flag'       => $splitArray[0].'.png',
                    'group_id'   => $groupId,
                    'total_matches' => $totalMatches,
                    'win'           => $win,
                    'loose'         => $loose,
                    'draw'          => $draw,
                    'Points'        => $points,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            });
        }
    }
}
