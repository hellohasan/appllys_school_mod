<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicSection extends Model
{
    protected $table = 'academic_sections';

    protected $fillable = [
        'name','seat','status'
    ];
}
