<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    public function users()
    
    {
        return $this->hasMany(User::class);
    }

    public function staff()
    
    {
        return $this->hasMany(Staff::class);
    }
    
}
