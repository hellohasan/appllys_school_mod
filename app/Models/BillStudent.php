<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillStudent extends Model
{
    use HasFactory;

    protected $table = 'bill_students';

    protected $guarded = [''];
}
