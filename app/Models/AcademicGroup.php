<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicGroup extends Model {
    /**
     * @var string
     */
    protected $table = 'academic_groups';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
    ];

    /**
     * @return mixed
     */
    public function sections() {
        return $this->belongsToMany(AcademicSection::class, 'academic_group_section')
            ->using(AcademicGroupSection::class);
    }

}
