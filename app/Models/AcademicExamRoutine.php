<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicExamRoutine extends Model {
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return mixed
     */
    public function academic_subject_level() {
        return $this->belongsTo(AcademicSubjectLevel::class, 'academic_subject_level_id');
    }

}
