<?php

namespace App\Models;

use App\Http\Traits\HelperTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicLevel extends Model {
    use HasFactory, HelperTrait;

    /**
     * @var string
     */
    protected $table = 'academic_levels';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $appends = ['details'];

    /**
     * @var array
     */
    protected $with = [
        'academicClass',
        'department',
        'group',
        'groupSection',
        'section',
        'year',
    ];

    /**
     * @return mixed
     */
    public function academicClass() {
        return $this->belongsTo(AcademicClass::class, 'academic_class_id');
    }

    /**
     * @return mixed
     */
    public function department() {
        return $this->belongsTo(AcademicDepartment::class, 'level_one_id');
    }

    /**
     * @return mixed
     */
    public function group() {
        return $this->belongsTo(AcademicGroup::class, 'level_one_id');
    }

    /**
     * @return mixed
     */
    public function year() {
        return $this->belongsTo(AcademicYear::class, 'level_two_id');
    }

    /**
     * @return mixed
     */
    public function section() {
        return $this->belongsTo(AcademicSection::class, 'level_one_id');
    }

    /**
     * @return mixed
     */
    public function groupSection() {
        return $this->belongsTo(AcademicSection::class, 'level_two_id');
    }

    /**
     * @return mixed
     */
    public function getDetailsAttribute() {
        return $this->academicLevelDetail($this);
    }
}
