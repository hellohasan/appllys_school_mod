<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicSession extends Model
{
    protected $table = 'academic_sessions';

    protected $fillable = [
        'title','start_year','end_year','duration','isCurrent','status','off_day','code'
    ];

    public function academic_classes()
    {
        return $this->belongsToMany(AcademicClass::class, 'academic_class_session')
            ->withPivot('admission_fee');
    }
}
