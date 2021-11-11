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
    public function academic_subject() {
        return $this->belongsTo(AcademicSubject::class, 'academic_subject_id');
    }

}
