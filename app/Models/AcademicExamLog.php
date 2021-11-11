<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicExamLog extends Model {
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'academic_exam_logs';

    /**
     * @var array
     */
    protected $guarded = [];
}
