<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicSubject extends Model {
    /**
     * @var string
     */
    protected $table = 'academic_subjects';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'mark_type',
        'theory',
        'practical',
        'full_mark',
        'subject_type',
        'point',
        'total_point',
        'optional_point',
        'religion_type',
        'religion_id',
        'online_url',
        'status',
    ];

    /**
     * @return mixed
     */
    public function religion() {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    /**
     * @return mixed
     */
    public function levels() {
        return $this->hasMany(AcademicSubjectLevel::class, 'academic_subject_id');
    }
}
