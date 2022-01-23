<?php

namespace App\Http\Controllers\API;

use DB;
use App\User;
use Response;
use App\Models\AcademicData;
use Illuminate\Http\Request;
use App\Models\AcademicLevel;
use App\Models\AcademicSubject;
use App\Models\AcademicDataSubject;
use App\Http\Controllers\Controller;
use App\Models\AcademicSubjectLevel;

class AttendanceController extends Controller {
    /**
     * @param Request $request
     */
    public function getSubjectList(Request $request) {
        $request->validate([
            "attendance_date"     => "required",
            'academic_session_id' => 'required',
            'academic_class_id'   => 'required',
            'academic_class_type' => 'required',
            'level_one_id'        => 'required',
            'level_two_id'        => 'required_unless:academic_class_type,0',
        ]);

        $level = AcademicLevel::whereAcademicClassId(request('academic_class_id'))
            ->whereType(request('academic_class_type'))
            ->whereLevelOneId(request('level_one_id'))
            ->whereLevelTwoId(request('level_two_id'))
            ->first();

        $subjectIds = AcademicSubjectLevel::whereAcademicClassId($level->academic_class_id)
            ->whereAcademicLevelId($level->id)
            ->pluck('academic_subject_id')
            ->toArray();

        // filter for teacher getSubjectStudentList
        $role = getRoleName();
        if ($role == 'Teacher') {

        } else {
            $subjects = AcademicSubject::whereIn('id', $subjectIds)
                ->select('id', DB::raw('CONCAT("(",code,") - ",name) as text'))
                ->get();
        }

        $data['subjects'] = $subjects;
        $data['academic_level_id'] = $level->id;
        return Response::json($data, 200);
    }

    /**
     * @param Request $request
     */
    public function getSubjectStudentList(Request $request) {
        $request->validate([
            'attendance_date'     => 'required',
            'academic_session_id' => 'required',
            'academic_class_id'   => 'required',
            'academic_class_type' => 'required',
            'level_id'            => 'required',
            'academic_subject_id' => 'required',
        ]);

        $dataIds = AcademicData::whereAcademicSessionId(request('academic_session_id'))
            ->whereAcademicLevelId(request('level_id'))
            ->pluck('id')
            ->toArray();

        $studentIds = AcademicDataSubject::whereIn('academic_data_id', $dataIds)
            ->whereAcademicSubjectId(request('academic_subject_id'))
            ->pluck('user_id')
            ->toArray();

        $academicSubject = AcademicSubject::find(request('academic_subject_id'));

        $data['subject_details'] = '(' . $academicSubject->code . ') - ' . $academicSubject->name;
        $data['students'] = User::with([
            'guardian.guardian',
        ])->whereIn('id', $studentIds)->get();

        return response()->json($data, 200);
    }
}
