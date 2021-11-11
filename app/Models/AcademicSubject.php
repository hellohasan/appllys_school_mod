<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicSubject extends Model {
    /**
     * @var string
     */
    protected $table = 'academic_subjects';

    /**
     * @var array
     */
    protected $fillable = [
        'academic_class_id',
        'academic_class_type',
        'academic_group_id',
        'academic_department_id',
        'academic_section_id',
        'academic_year_id',
        'name',
        'code',
        'mark_type',
        'theory',
        'practical',
        'full_mark',
        'subject_type',
        'point',
        'total_point',
        'optional_point',
        'religion_type',
        'religion_id',
        'status',
    ];

    /**
     * @return mixed
     */
    public function religion() {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    /**
     * @return mixed
     */
    public function academic_class() {
        return $this->belongsTo(AcademicClass::class, 'academic_class_id');
    }

    /**
     * @return mixed
     */
    public function academic_group() {
        return $this->belongsTo(AcademicGroup::class, 'academic_group_id');
    }

    /**
     * @return mixed
     */
    public function academic_department() {
        return $this->belongsTo(AcademicDepartment::class, 'academic_department_id');
    }

    /**
     * @return mixed
     */
    public function department_year() {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    /**
     * @return mixed
     */
    public function academic_section() {
        return $this->belongsTo(AcademicSection::class, 'academic_section_id');
    }

}
