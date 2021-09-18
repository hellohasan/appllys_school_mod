<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicData extends Model
{
    protected $guarded = [''];

    protected $appends = ['group_department'];

    public function session()
    {
        return $this->belongsTo(AcademicSession::class, 'academic_session_id');
    }

    public function class()
    {
        return $this->belongsTo(AcademicClass::class, 'academic_class_id');
    }

    public function department()
    {
        return $this->belongsTo(AcademicDepartment::class, 'academic_department_id');
    }

    public function group()
    {
        return $this->belongsTo(AcademicGroup::class, 'academic_group_id');
    }

    public function section()
    {
        return $this->belongsTo(AcademicSection::class, 'academic_section_id');
    }

    public function year()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function getGroupDepartmentAttribute()
    {
        if ($this->type == 2) {
            return $this->department;
        }

        if ($this->type == 1) {
            return $this->group;
        }

        return null;

    }

    public function subjects()
    {
        return $this->hasMany(AcademicDataSubject::class, 'academic_data_id');
    }

    public function optionalSubject()
    {
        return $this->subjects()->where('isOptional', true);
    }
}
