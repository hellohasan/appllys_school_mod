<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class AcademicClassGroup extends Pivot
{
    protected $table = 'academic_class_group';

    protected $fillable = ['academic_class_id','academic_group_id'];

}
