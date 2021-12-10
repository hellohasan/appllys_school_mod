<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeacherSubject extends Model {
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return mixed
     */
    public function assign() {
        return $this->belongsTo(SubjectAssign::class, 'subject_assign_id');
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
    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
