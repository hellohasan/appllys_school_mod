<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $guarded = [''];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function presentDivision()
    {
        return $this->belongsTo(Division::class);
    }

    public function presentDistrict()
    {
        return $this->belongsTo(District::class);
    }

    public function presentUpazila()
    {
        return $this->belongsTo(Upazila::class);
    }
}
