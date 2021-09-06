<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'divisions';

    public $timestamps = false;

    public function districts()
    {
        return $this->hasMany(District::class,'division_id');
    }
}
