<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpenseItems extends Model {
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'expense_items';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return mixed
     */
    public function item() {
        return $this->belongsTo(BillItem::class, 'bill_item_id');
    }
}
