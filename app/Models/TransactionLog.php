<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionLog extends Model {
    use HasFactory, SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'transaction_logs';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return mixed
     */
    public function logable() {
        return $this->morphTo();
    }

    /**
     * @return mixed
     */
    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
