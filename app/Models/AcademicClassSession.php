<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicClassSession extends Model
{
    protected $table = 'academic_class_session';

    public $timestamps = false;

    protected $guarded = ['academic_class_id','academic_session_id','admission_fee'];
}
