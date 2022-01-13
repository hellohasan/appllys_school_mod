<?php
namespace App\Http\Traits;

use App\Models\AcademicClass;
use App\Models\AcademicLevel;

trait HelperTrait {
    /**
     * @param $classDetails
     * @param $type
     * @param null $levelOne
     * @param $levelTwo
     */
    public static function findAcademicLevelID($classID, $type = null, $levelOneId, $levelTwoId = null) {
        if ($type == 0) {
            $level = AcademicLevel::whereAcademicClassId($classID)->whereType($type)->whereLevelOneId($levelOneId); // only section
        } else {
            $level = AcademicLevel::whereAcademicClassId($classID)->whereType($type)->whereLevelOneId($levelOneId)->whereLevelTwoId($levelTwoId); // group section & department year
        }
        return $level->first()->id;
    }

    /**
     * @param $level
     */
    public static function academicLevelDetail($level) {

        $class = $level->academicClass;
        if ($level->type == 2) {
            $department = $level->department;
            $year = $level->year;
            return [
                'type'    => '2',
                'details' => $class->name . ' - ' . $department->name . ' - ' . $year->name,
            ];
        } elseif ($level->type == 1) {
            $group = $level->group;
            $section = $level->groupSection;
            return [
                'type'    => '1',
                'details' => $class->name . ' - ' . $group->name . ' - ' . $section->name,
            ];
        } else {
            $section = $level->section;
            return [
                'type'    => '0',
                'details' => $class->name . ' - ' . $section->name,
            ];
        }
    }

    /**
     * @param $classDetails
     * @param $type
     * @param null $levelOne
     * @param $levelTwo
     */
    public static function getAcademicLevelIDs($classDetails, $type = null, $levelOne = null, $levelTwo = null) {
        if (is_object($classDetails)) {

        } else {
            $class = AcademicClass::find($classDetails);
            if ($class->type == 2) {

            } elseif ($class->type == 1) {

            } else {

            }
        }
    }

    /**
     * @param $classId
     * @param $type
     * @param $levelOne
     * @param null $levelTwo
     */
    public static function getAcademicLevelId($classId, $type, $levelOne = null, $levelTwo = null) {
        if ($type == 1 || $type == 2) {
            $level = AcademicLevel::whereAcademicClassId($classId)->whereLevelOneId($levelOne)->whereLevelTwoId($levelTwo)->first();
        } else {
            $level = AcademicLevel::whereAcademicClassId($classId)->whereLevelOneId($levelOne)->first();
        }
        return $level->id;
    }
}
