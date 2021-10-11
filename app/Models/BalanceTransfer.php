<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BalanceTransfer extends Model {
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'balance_transfers';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return mixed
     */
    public function logs() {
        return $this->morphMany(TransactionLog::class, 'logable')->orderByDesc('id');
    }

    /**
     * @return mixed
     */
    public function sender_account() {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    /**
     * @return mixed
     */
    public function receive_account() {
        return $this->belongsTo(Account::class, 'to_account_id');
    }

    /**
     * @return mixed
     */
    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
