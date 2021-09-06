<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradePercentage extends Model
{
    protected $table = 'grade_percentages';

    protected $fillable = ['academic_grade_id','name','min_percentage','max_percentage'];
}
