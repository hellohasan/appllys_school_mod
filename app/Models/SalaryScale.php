<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryScale extends Model
{
    protected $table = 'salary_scales';

    protected $fillable = ['title','amount','status'];
}
