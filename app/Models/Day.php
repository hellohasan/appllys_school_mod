<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Day extends Model {
    use HasFactory;

    /**
     * @var mixed
     */
    protected $timestamp = false;

    /**
     * @var string
     */
    protected $table = 'days';
}
