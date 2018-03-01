<?php

namespace App\Repositories;

use App\Models\Groups;
use App\Interfaces\GroupInterFace;

/**
 * Created by PhpStorm.
 * User: Rohit
 * Date: 1/3/18
 * Time: 12:03 PM
 */
class GroupRepository implements GroupInterFace
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * getting all teams with groups
     * @author Rohit N.
     */
    public function getGroupsWithTeams()
    {
        return Groups::with([
            'teams' => function ($query) {
                $query->orderBy('points', 'desc');
            }
        ])->get();
    }

}