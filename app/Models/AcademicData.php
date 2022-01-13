<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AcademicData extends Model {
    /**
     * @var array
     */
    protected $guarded = [''];

    //protected $appends = ['group_department','academic_data'];

    /**
     * @return mixed
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public function session() {
        return $this->belongsTo(AcademicSession::class, 'academic_session_id');
    }

    public function class () {
        return $this->belongsTo(AcademicClass::class, 'academic_class_id');
    }

    /**
     * @return mixed
     */
    public function subjects() {
        return $this->hasMany(AcademicDataSubject::class, 'academic_data_id');
    }

    /**
     * @return mixed
     */
    public function optionalSubject() {
        return $this->subjects()->where('isOptional', true);
    }

    /**
     * @return mixed
     */
    public function level() {
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }
}
