<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicSubjectLevel extends Model {
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'academic_subject_levels';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return mixed
     */
    public function subject() {
        return $this->belongsTo(AcademicSubject::class, 'academic_subject_id');
    }

    /**
     * @return mixed
     */
    public function level() {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }
}
