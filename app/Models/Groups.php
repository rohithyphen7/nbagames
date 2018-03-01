<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{

    protected $table = 'groups';

    public function teams()
    {
        return $this->hasMany(Teams::class,'group_id','id');
    }

}
