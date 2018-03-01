<?php

use Illuminate\Database\Seeder;
use App\Models\Teams;
use App\Models\Players;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PlayersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        if (Players::all()->count() >= 1) {
            Players::truncate();
        }
        $teams = Teams::all();
        if ($teams) {
            $teams->each(function ($team, $key) use ($faker) {
                for ($i = 1; $i <= 12; $i++) {
                    Players::insert([
                        'name'                   => $faker->firstName('male') . " " . $faker->lastName,
                        'age'                    => $faker->numberBetween(18, 35),
                        'height'                 => $faker->randomFloat(2,188, 234),
                        'weight'                 => $faker->randomFloat(2,188, 300),
                        'experience'             => $faker->randomFloat(1,0, 20),
                        'rebound'                => $faker->randomFloat(2,1, 10),
                        'assist'                 => $faker->randomFloat(2,1, 10),
                        'points'                 => $faker->randomFloat(2,1, 55),
                        'player_impact_estimate' => $faker->randomFloat(2,1, 30),
                        'team_id'                => $team->id,
                        'created_at'             => Carbon::now(),
                        'updated_at'             => Carbon::now(),
                    ]);
                }
            });
        }
    }
}
