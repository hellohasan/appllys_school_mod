<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\AcademicClassGroup;

class AcademicClass extends Model
{
    protected $table = 'academic_classes';

    protected $fillable = [
        'name','code','type','status','academic_grading_id'
    ];

    public function grading()
    {
        return $this->belongsTo(AcademicGrade::class,'academic_grading_id');
    }

    public function academicGroups()
    {
        return $this->belongsToMany(AcademicGroup::class,'academic_class_group')
            ->using(AcademicClassGroup::class)
            ->withTimestamps();
    }

    public function academicDepartments()
    {
        return $this->belongsToMany(AcademicDepartment::class,'academic_class_department')
            ->using(AcademicClassDepartment::class)
            ->withTimestamps();
    }

    public function sections()
    {
        return $this->belongsToMany(AcademicSection::class, 'academic_class_section')
            ->using(AcademicClassSection::class)
            ->withTimestamps();
    }

    public function academic_sessions()
    {
        return $this->belongsToMany(AcademicSession::class, 'academic_class_academic_session')
            ->withPivot('admission_fee');
    }
}
