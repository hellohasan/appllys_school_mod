<?php

namespace App\Http\Controllers\API\Teacher;

use App\Models\AcademicData;
use Illuminate\Http\Request;
use App\Models\TeacherSubject;
use App\Http\Controllers\Controller;

class TeacherController extends Controller {
    /**
     * @param Request $request
     */
    public function loadTeacherSessionSubjectList(Request $request) {
        $lists = TeacherSubject::with([
            'assign.academicClass:id,name',
            'assign.section:id,name',
            'assign.group:id,name',
            'assign.groupSection:id,name',
            'assign.department:id,name',
            'assign.year:id,name',
            'subject:id,name,code',
        ])
            ->whereTeacherId(auth()->id())
            ->whereAcademicSessionId($request->input("session_id"))
            ->get();
        $rr = [];
        foreach ($lists as $key => $list) {
            $rr[$key]['id'] = $list->id;
            if ($list->assign->type == 2) {
                $rr[$key]['text'] = $list->assign->academicClass->name . ' - ' . $list->assign->department->name . ' - ' . $list->assign->year->name . ' - ' . $list->subject->name . ' (' . $list->subject->code . ')';
            } elseif ($list->assign->type == 1) {
                $rr[$key]['text'] = $list->assign->academicClass->name . ' - ' . $list->assign->group->name . ' - ' . $list->assign->groupSection->name . ' - ' . $list->subject->name . ' (' . $list->subject->code . ')';
            } else {
                $rr[$key]['text'] = $list->assign->academicClass->name . ' - ' . $list->assign->section->name . ' - ' . $list->subject->name . ' (' . $list->subject->code . ')';
            }
        }

        return response()->json($rr, 200);
    }

    /**
     * @param Request $request
     */
    public function loadTeacherStudentList(Request $request) {
        $request->validate([
            "session_id"         => "required",
            'teacher_subject_id' => 'required',
        ]);

        $subject = TeacherSubject::with([
            'assign.academicSession:id,duration',
            'assign.academicClass:id,name',
            'assign.section:id,name',
            'assign.group:id,name',
            'assign.groupSection:id,name',
            'assign.department:id,name',
            'assign.year:id,name',
            'subject:id,name,code',
        ])->find($request->input("teacher_subject_id"));

        $detail = $subject->assign;
        $data['detail'] = $detail;
        $data['subject'] = $subject->subject;

        $students = AcademicData::query();
        $students = $students->with([
            'user:id,name,photo,phone',
            'user.guardian.guardian:id,name,photo,phone',
        ])->whereAcademicSessionId($request->input("session_id"))
            ->whereAcademicClassId($detail->academic_class_id);

        if ($detail->type == 2) {
            $students = $students->whereAcademicDepartmentId($detail->academic_department_id)->whereAcademicYearId($detail->academic_year_id);
        } elseif ($detail->type == 1) {
            $students = $students->whereAcademicGroupId($detail->academic_group_id)->whereAcademicSectionId($detail->academic_group_section_id);
        } else {
            $students = $students->whereAcademicSectionId($detail->academic_section_id);
        }
        $data['students'] = $students->get();

        return $data;
    }
}
