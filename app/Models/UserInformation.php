<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $guarded = [''];

    public function religion()
    {
        return $this->belongsTo(Religion::class,'religion_id');
    }
}
