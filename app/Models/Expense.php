<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model {
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'expenses';

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

    public function items()
    {
        return $this->hasMany(ExpenseItems::class,'expense_id');
    }

}
