<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ParentUser extends Model
{
    protected $table = 'parent_user';

    protected $fillable = ['parent_id','user_id','info_id'];

    public function guardian()
    {
        return $this->belongsTo(User::class,'parent_id');
    }

    public function guardianInformation()
    {
        return $this->belongsTo(UserParent::class,'info_id');
    }
}
