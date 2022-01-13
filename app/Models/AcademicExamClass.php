<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicExamClass extends Model {
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'academic_exam_classes';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var mixed
     */
    public $timestamps = false;

    /**
     * @return mixed
     */
    public function academicClass() {
        return $this->belongsTo(AcademicClass::class, 'academic_class_id');
    }

    /**
     * @return mixed
     */
    public function logs() {
        return $this->hasMany(AcademicExamLog::class, 'academic_exam_class_id');
    }

    /**
     * @return mixed
     */
    public function exam() {
        return $this->hasOne(AcademicExam::class, 'id', 'academic_exam_id');
    }

    /**
     * @return mixed
     */
    public function level() {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }
}
