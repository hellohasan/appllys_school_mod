<?php

namespace App\Http\Controllers\API;

use App\Models\AcademicYear;
use App\Models\AcademicClass;
use App\Models\AcademicGroup;
use App\Models\AcademicLevel;
use App\Models\AcademicSection;
use App\Models\AcademicDepartment;
use App\Http\Controllers\Controller;

class AcademicLevelController extends Controller {
    public function createAcademicLevel() {
        //AcademicLevel::truncate();
        $classes = AcademicClass::get();
        foreach ($classes as $class) {
            $data['academic_class_id'] = $class->id;
            $data['type'] = $class->type;
            if ($class->type == 2) {
                $departments = AcademicDepartment::get();
                foreach ($departments as $department) {
                    $data['level_one_id'] = $department->id;
                    $years = AcademicYear::all();
                    foreach ($years as $year) {
                        $data['level_two_id'] = $year->id;
                        $levelC = AcademicLevel::whereAcademicClassId($class->id)
                            ->whereType($class->type)
                            ->whereLevelOneId($department->id)
                            ->whereLevelTwoId($year->id)
                            ->exists();
                        if (!$levelC) {
                            AcademicLevel::create($data);
                        }
                    }
                }
            } elseif ($class->type == 1) {
                $groups = AcademicGroup::get();
                foreach ($groups as $group) {
                    $data['level_one_id'] = $group->id;
                    $sections = AcademicSection::get();
                    foreach ($sections as $section) {
                        $data['level_two_id'] = $section->id;
                        $levelC = AcademicLevel::whereAcademicClassId($class->id)
                            ->whereType($class->type)
                            ->whereLevelOneId($group->id)
                            ->whereLevelTwoId($section->id)
                            ->exists();
                        if (!$levelC) {
                            AcademicLevel::create($data);
                        }
                    }
                }
            } else {
                $sections = AcademicSection::get();
                foreach ($sections as $section) {
                    $data['level_one_id'] = $section->id;
                    $levelC = AcademicLevel::whereAcademicClassId($class->id)
                        ->whereType($class->type)
                        ->whereLevelOneId($section->id)
                        ->exists();
                    if (!$levelC) {
                        AcademicLevel::create($data);
                    }
                }
            }
        }
    }
}
