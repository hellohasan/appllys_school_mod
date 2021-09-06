<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AcademicGrade extends Model
{
    protected $table = 'academic_grades';

    protected $fillable = ['name','status'];

    public function percentages()
    {
        return $this->hasMany(GradePercentage::class,'academic_grade_id');
    }
}
