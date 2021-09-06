<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherEducation extends Model
{
    protected $table = 'teacher_education';

    protected $fillable = ['teacher_id','name'];
}
