<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

class BillPackage extends Model
{
    use HasFactory;
    use HasJsonRelationships;

    protected $table = 'bill_packages';

    protected $guarded = [''];

    protected $casts = [
        'items' => 'array'
    ];

    public function setItemsAttribute($value)
    {

        $list = [];
        foreach ($value as $array_item) {
            if ($array_item['amount'] != 0) {
                $list[] = $array_item;
            }
        }
        $this->attributes['items'] = json_encode($list);
    }

    /*public function billItems()
    {
        return $this->hasManyJson(BillItem::class, 'items[]->bill_item_id','id');
    }*/


    public function billStudents()
    {
        return $this->hasMany(BillStudent::class,'bill_package_id');
    }

    public function academic_session()
    {
        return $this->belongsTo(AcademicSession::class,'academic_session_id');
    }

    public function academic_class()
    {
        return $this->belongsTo(AcademicClass::class,'academic_class_id');
    }

    public function academic_group()
    {
        return $this->belongsTo(AcademicGroup::class,'academic_group_id');
    }

    public function academic_department()
    {
        return $this->belongsTo(AcademicDepartment::class,'academic_department_id');
    }

    public function academic_section()
    {
        return $this->belongsTo(AcademicSection::class,'academic_section_id');
    }

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class,'academic_year_id');
    }

}
