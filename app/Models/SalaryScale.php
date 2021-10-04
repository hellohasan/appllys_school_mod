<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryScale extends Model {
    /**
     * @var string
     */
    protected $table = 'salary_scales';

    /**
     * @var array
     */
    protected $fillable = ['title', 'amount', 'status'];

    /**
     * @return mixed
     */
    public function users() {
        return $this->hasMany(UserSalaryScale::class, 'salary_scale_id');
    }
}
