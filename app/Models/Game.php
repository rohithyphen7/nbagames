<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function teamA()
    {
        return $this->belongsTo(Teams::class,'teamA_id','id');

    }

    public function teamB()
    {
        return $this->belongsTo(Teams::class,'teamB_id','id');

    }

    public function scoreOfTeamA()
    {
        return $this->hasMany(Scores::class,'team_id','teamA_id');
    }

    public function scoreOfTeamB()
    {
        return $this->hasMany(Scores::class,'team_id','teamB_id');
    }
}
