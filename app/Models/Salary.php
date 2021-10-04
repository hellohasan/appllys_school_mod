<?php

namespace App\Models;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salary extends Model {
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'salaries';

    /**
     * @return mixed
     */
    public function salaries() {
        return $this->hasMany(SalaryLog::class, 'salary_id');
    }

    /**
     * @return mixed
     */
    public function logs() {

        return $this->morphMany(TransactionLog::class, 'logable');
    }

    /**
     * @return mixed
     */
    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return mixed
     */
    public function role() {
        return $this->belongsTo(Role::class, 'role_id')->withDefault([
            'name' => __('All'),
        ]);
    }
}
