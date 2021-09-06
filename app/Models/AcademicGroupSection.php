<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AcademicGroupSection extends Pivot
{
    protected $table = 'academic_group_section';

    protected $fillable = ['academic_group_id','academic_section_id'];
}
