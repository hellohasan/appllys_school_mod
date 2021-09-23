<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AcademicData extends Model
{
    protected $guarded = [''];

    protected $appends = ['group_department','academic_data'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

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

    public function getAcademicDataAttribute()
    {
        $class = $this->class;
        if ($this->type == 2) {
            $department =  $this->department;
            $year = $this->year;
            return [
                'type' => '2',
                'class' => $class->name,
                'academic_id' => $this->custom,
                'department' => $department->name,
                'year' => $year->name
            ];
        }elseif ($this->type == 1) {
            $group = $this->group;
            $section = $this->section;
            return [
                'type' => '1',
                'class' => $class->name,
                'academic_id' => $this->custom,
                'group' => $group->name,
                'section' => $section->name
            ];
        }else{
            $section = $this->section;
            return [
                'type' => '0',
                'class' => $class->name,
                'academic_id' => $this->custom,
                'section' => $section->name
            ];
        }
    }


}
