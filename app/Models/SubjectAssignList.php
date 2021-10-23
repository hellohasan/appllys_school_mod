<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectAssignList extends Model {
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'subject_assign_lists';

    /**
     * @var array
     */
    protected $fillable = [
        'subject_assign_id',
        'academic_subject_id',
        'day_id',
        'teacher_id',
        'period_id',
    ];

    /**
     * @return mixed
     */
    public function academicSubject() {
        return $this->belongsTo(AcademicSubject::class, 'academic_subject_id');
    }

    /**
     * @return mixed
     */
    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * @return mixed
     */
    public function day() {
        return $this->belongsTo(Day::class, 'day_id');
    }

    /**
     * @return mixed
     */
    public function period() {
        return $this->belongsTo(ClassPeriod::class, 'period_id');
    }
}
