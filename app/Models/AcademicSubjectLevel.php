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
}
