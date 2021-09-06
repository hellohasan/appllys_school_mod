<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';

    protected $fillable = [
        'user_id',
        'code',
        'type',
        'academic_group_id',
        'academic_department_id',
        'designation_id',
        'religion_id',
        'salary_scale_id',
        'blood',
        'join_date',
    ];

    public function academicDepartment()
    {
        return $this->belongsTo(AcademicDepartment::class,'academic_department_id');
    }

    public function academicGroup()
    {
        return $this->belongsTo(AcademicGroup::class,'academic_group_id');
    }


    /*public function academicGroupDepartment()
    {
        if (!$this->type) {
            $value = $this->belongsTo(AcademicDepartment::class,'academic_department_id');
        }else{
            $value = $this->belongsTo(AcademicGroup::class,'academic_group_id');
        }

        return $value;
    }*/

    public function salaryScale()
    {
        return $this->belongsTo(SalaryScale::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function educations()
    {
        return $this->hasMany(TeacherEducation::class,'teacher_id');
    }
}
