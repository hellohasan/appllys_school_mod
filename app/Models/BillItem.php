<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    use HasFactory;

    protected $table = 'bill_items';

    protected $fillable = ['title','item_for','default_amount','activated'];
}
