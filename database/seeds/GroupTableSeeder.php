<?php

use Illuminate\Database\Seeder;
use App\Models\Groups;
use Carbon\Carbon;

class GroupTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Groups::all()->count() >= 1) {
            Groups::truncate();
        }
        //teams are coming from config file
        $teams = collect(config('nba_config.groups'));
        if ( !empty($teams)) {
            $teams->each(function ($groupName) {
                Groups::insert([
                    'name'       => $groupName,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            });
        }
    }
}
