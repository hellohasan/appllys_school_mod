<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalaryLog extends Model {
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'salary_logs';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return mixed
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function scale() {
        return $this->belongsTo(SalaryScale::class, 'salary_scale_id');
    }

    /**
     * @return mixed
     */
    public function account() {
        return $this->belongsTo(Account::class, 'account_id');
    }

}
