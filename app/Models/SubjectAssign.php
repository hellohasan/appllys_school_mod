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
        'academic_level_id',
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
    public function teachers() {
        return $this->hasMany(TeacherSubject::class, 'subject_assign_id');
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
        return $this->belongsTo(AcademicClass::class, 'academic_class_id');
    }

    /**
     * @return mixed
     */
    public function academicLevel() {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }

}
