<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectAssign extends Model {
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'subject_assigns';

    /**
     * @var array
     */
    protected $fillable = [
        'session_id',
        'academic_class_id',
        'type',
        'academic_section_id',
        'academic_group_id',
        'academic_group_section_id',
        'academic_department_id',
        'academic_year_id',
    ];

    /**
     * @return mixed
     */
    public function lists() {
        return $this->hasMany(SubjectAssignList::class, 'subject_assign_id');
    }

    /**
     * @return mixed
     */
    public function academicSession() {
        return $this->belongsTo(AcademicSession::class, 'session_id');
    }

    /**
     * @return mixed
     */
    public function academicClass() {
        return $this->belongsTo(AcademicClass::class);
    }

    /**
     * @return mixed
     */
    public function section() {
        return $this->belongsTo(AcademicSection::class, 'academic_section_id');
    }

    /**
     * @return mixed
     */
    public function group() {
        return $this->belongsTo(AcademicGroup::class, 'academic_group_id');
    }

    /**
     * @return mixed
     */
    public function groupSection() {
        return $this->belongsTo(AcademicSection::class, 'academic_group_section_id');
    }

    /**
     * @return mixed
     */
    public function department() {
        return $this->belongsTo(AcademicDepartment::class, 'academic_department_id');
    }

    /**
     * @return mixed
     */
    public function year() {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

}
