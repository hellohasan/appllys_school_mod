<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassPeriod extends Model
{
    protected $table = 'class_periods';

    protected $fillable = ['title','start','end','show'];
}
