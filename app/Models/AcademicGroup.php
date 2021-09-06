<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AcademicGroup extends Model
{
    protected $table = 'academic_groups';

    protected $fillable = [
        'name',
        'status'
    ];

    public function sections()
    {
        return $this->belongsToMany(AcademicSection::class,'academic_group_section')
            ->using(AcademicGroupSection::class)
            ->withTimestamps();
    }

}
