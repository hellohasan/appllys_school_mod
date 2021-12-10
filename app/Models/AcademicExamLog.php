<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicExamLog extends Model {
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'academic_exam_logs';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return mixed
     */
    public function dataSubject() {
        return $this->belongsTo(AcademicDataSubject::class, 'academic_data_subject_id');
    }

    /**
     * @return mixed
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function subject() {
        return $this->belongsTo(AcademicSubject::class, 'academic_subject_id');
    }

    /**
     * @return mixed
     */
    public function academicExamClass() {
        return $this->belongsTo(AcademicExamClass::class, 'academic_exam_class_id');
    }

    /**
     * @return mixed
     */
    public function grade() {
        return $this->belongsTo(GradePercentage::class, 'grade_percentage_id')->withDefault([
            'name' => 'N/A',
        ]);
    }
}
