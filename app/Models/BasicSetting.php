<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class BasicSetting extends Model implements TranslatableContract
{

    use Translatable;

    protected $table = 'basic_settings';

    public $translatedAttributes = ['name'];

    protected $guarded = [''];
}
