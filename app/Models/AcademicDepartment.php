<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicDepartment extends Model
{
    protected $table = 'academic_departments';

    protected $fillable = ['name', 'status'];

    public function sections()
    {
        return $this->belongsToMany(AcademicYear::class,'academic_department_year')
            ->using(AcademicDepartmentYear::class)
            ->withTimestamps();
    }
}
