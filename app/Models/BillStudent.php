<?php

namespace App\Models;

use App\User;
use App\Models\TransactionLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BillStudent extends Model {
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'bill_students';

    /**
     * @var array
     */
    protected $guarded = [''];

    /**
     * @return mixed
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function receiver() {
        return $this->belongsTo(User::class, 'receive_by');
    }

    /**
     * @return mixed
     */
    public function package() {
        return $this->belongsTo(BillPackage::class, 'bill_package_id');
    }

    /**
     * @return mixed
     */
    public function logs() {
        return $this->morphMany(TransactionLog::class, 'logable')->orderByDesc('id');
    }

    /**
     * @return mixed
     */
    public function log() {
        return $this->morphOne(TransactionLog::class, 'logable')->latest();
    }

}
