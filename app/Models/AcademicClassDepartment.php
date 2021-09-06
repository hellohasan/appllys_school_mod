<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AcademicClassDepartment extends Pivot
{
    protected $table = 'academic_class_department';

    protected $fillable = ['academic_class_id','academic_department_id'];
}
