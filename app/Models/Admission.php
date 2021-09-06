<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $table = 'admissions';

    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function academic()
    {
        return $this->belongsTo(AcademicData::class,'academic_data_id');
    }

}
