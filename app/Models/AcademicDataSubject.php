<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicDataSubject extends Model
{
    protected $guarded = [''];

    public function academicSubject()
    {
        return $this->belongsTo(AcademicSubject::class,'academic_subject_id');
    }
}
