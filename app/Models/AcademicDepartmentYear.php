<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AcademicDepartmentYear extends Pivot
{
    protected $table = 'academic_department_year';

    protected $fillable = ['academic_department_id','academic_year_id'];
}
