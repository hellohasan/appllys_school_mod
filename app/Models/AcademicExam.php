<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicExam extends Model {
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'academic_exams';

    /**
     * @var array
     */
    protected $fillable = ['title', 'start_date', 'end_date', 'custom', 'created_by', 'academic_session_id'];

    /**
     * @return mixed
     */
    public function classes() {
        return $this->hasMany(AcademicExamClass::class, 'academic_exam_id');
    }

    /**
     * @return mixed
     */
    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return mixed
     */
    public function session() {
        return $this->belongsTo(AcademicSession::class, 'academic_session_id');
    }

    /**
     * @return mixed
     */
    public function routines() {
        return $this->hasMany(AcademicExamRoutine::class, 'academic_exam_id');
    }

    /**
     * @return mixed
     */
    public function students() {
        return $this->hasMany(AcademicExamLog::class, 'academic_exam_id');
    }
}
