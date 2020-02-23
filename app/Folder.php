<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public function Tasks()
    {
        return $this->hasMany('App\Task');
    }
}
