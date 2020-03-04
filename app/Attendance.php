<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];
    
    protected $table = 'attendances';

    public $primarykey = 'id';

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    } 
}
