<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    public $timestamps = false;

    public function upazilas()
    {
        return $this->hasMany(Upazila::class,'district_id');
    }
}
