<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AcademicClassSection extends Pivot
{
    protected $table = 'academic_class_section';

    protected $fillable = ['academic_class_id','academic_section_id'];
}
