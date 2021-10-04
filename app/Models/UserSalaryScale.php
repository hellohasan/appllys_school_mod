<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSalaryScale extends Model {
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'user_salary_scales';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return mixed
     */
    public function salary_scale() {
        return $this->belongsTo(SalaryScale::class, 'salary_scale_id');
    }

}
