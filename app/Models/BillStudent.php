<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillStudent extends Model
{
    use HasFactory;

    protected $table = 'bill_students';

    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receive_by');
    }

    public function package()
    {
        return $this->belongsTo(BillPackage::class,'bill_package_id');
    }

}
