<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model


{
    protected $guarded = [];
    
    protected $table = 'users';

    public $primarykey = 'id';

    public $timestamps = true;

    public function designation()
    
    {
        return $this->belongsTo(Designation::class);
    }
}
