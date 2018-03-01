<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    public function players()
    {
        return $this->hasMany(Players::class,'team_id','id');
    }

    public function groups()
    {
        return $this->belongsTo(Groups::class,'group_id','id');
    }
}
