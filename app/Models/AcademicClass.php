<?php

namespace App\Models;

use App\Models\AcademicClassGroup;
use Illuminate\Database\Eloquent\Model;

class AcademicClass extends Model {
    /**
     * @var string
     */
    protected $table = 'academic_classes';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'type', 'status', 'academic_grading_id',
    ];

    /**
     * @return mixed
     */
    public function grading() {
        return $this->belongsTo(AcademicGrade::class, 'academic_grading_id');
    }

    /**
     * @return mixed
     */
    public function academicGroups() {
        return $this->belongsToMany(AcademicGroup::class, 'academic_class_group')
            ->using(AcademicClassGroup::class);
    }

    /**
     * @return mixed
     */
    public function academicDepartments() {
        return $this->belongsToMany(AcademicDepartment::class, 'academic_class_department')
            ->using(AcademicClassDepartment::class)
            ->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function sections() {
        return $this->belongsToMany(AcademicSection::class, 'academic_class_section')
            ->using(AcademicClassSection::class);
    }

    /**
     * @return mixed
     */
    public function academic_sessions() {
        return $this->belongsToMany(AcademicSession::class, 'academic_class_academic_session')
            ->withPivot('admission_fee');
    }
}
