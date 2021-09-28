<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model {
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'accounts';

    /**
     * @var array
     */
    protected $guarded = [''];

    /**
     * @var array
     */
    protected $casts = [
        'details' => 'array',
    ];

    /**
     * @return mixed
     */
    public function cash() {
        return $this->first();
    }
}
