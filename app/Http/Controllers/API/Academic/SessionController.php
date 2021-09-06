<?php

namespace App\Http\Controllers\API\Academic;

use App\Models\AcademicSession;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Super Admin|Admin|Register','permission:session-create|session-edit|session-update']);
    }

    public function loadAcademicSession()
    {
        return AcademicSession::select(['id','duration as text'])->orderBy('id','desc')->get();
    }

    public function getAcademicSession()
    {
        return AcademicSession::orderBy('id', 'desc')->get();
    }

    public function storeAcademicSession(Request $request)
    {
        $request->validate([
            "title" => "required|unique:academic_sessions",
            "code" => 'required|unique:academic_sessions',
            "start_year" => 'required|numeric|digits:4',
            "end_year" => 'required|numeric|digits:4',
            'duration' => 'required|unique:academic_sessions',
            "off_day" => 'required',
            "classes" => 'required|array'
        ]);

        $in = $request->all();
        $session = AcademicSession::create($in);

        if ($request->input("isCurrent")) {
            $sessions = AcademicSession::all()->except($session->id);
            foreach ($sessions as $s) {
                $s->isCurrent = 0;
                $s->save();
            }
        }
        foreach ($request->classes as $class){
            $session->academic_classes()->attach($class['id'], ['admission_fee'=> $class['admission_fee'] ]);
        }


    }

    public function editAcademicSession($id)
    {
        return AcademicSession::with(['academic_classes:id,name'])->find($id);
    }

    public function updateAcademicSession(Request $request, $id): void
    {
        $session = AcademicSession::findOrFail($id);
        $request->validate([
            "title" => "required|unique:academic_sessions,title," . $id,
            "code" => 'required|unique:academic_sessions,code,' . $id,
            "start_year" => 'required|numeric|digits:4',
            "end_year" => 'required|numeric|digits:4',
            'duration' => 'required|unique:academic_sessions,duration,' . $id,
            "off_day" => 'required',
        ]);
        $in = $request->all();
        $session->update($in);

        if ($request->input("isCurrent")) {
            $sessions = AcademicSession::all()->except($session->id);
            foreach ($sessions as $s) {
                $s->isCurrent = 0;
                $s->save();
            }
        }

        if ($request->classes) {
            $session->academic_classes()->detach();
            foreach ($request->classes as $class){
                $session->academic_classes()->attach($class['id'], ['admission_fee'=> $class['admission_fee'] ]);
            }
        }

    }
}
