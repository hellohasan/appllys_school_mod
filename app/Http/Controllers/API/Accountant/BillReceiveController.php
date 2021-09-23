<?php

namespace App\Http\Controllers\API\Accountant;

use App\Http\Controllers\Controller;
use App\Models\AcademicData;
use App\Models\BillStudent;
use App\User;
use Illuminate\Http\Request;

class BillReceiveController extends Controller
{
    public function receiveSpecificStudentBill(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $user = User::with([
            'father','mother','guardian.guardianInformation','address'
        ])->role('Student')->find($request->input("id"));
        if ($user) {
            $academicData = AcademicData::orderByDesc('academic_session_id')->whereUserId($user->id)->first();
            $data['academic_data'] = $academicData->academic_data;
            $data['student_data'] = [
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'photo' => asset($user->photo)
            ];
            $father = $user->father;
            $mother = $user->mother;
            $guardian = $user->guardian->guardianInformation;
            $data['guardian_data'] = [
                'father_name' => $father[0]->name,
                'father_name_bn' => $father[0]->name_bn,
                'father_phone' => $father[0]->phone,
                'father_image' => asset($father[0]->image),
                'mother_name' => $mother[0]->name,
                'mother_name_bn' => $mother[0]->name_bn,
                'mother_phone' => $mother[0]->phone,
                'mother_image' => asset($mother[0]->image),
                'guardian_name' => $guardian->name,
                'guardian_name_bn' => $guardian->name_bn,
                'guardian_phone' => $guardian->phone,
                'guardian_image' => asset($guardian->image)
            ];

            $billQ = BillStudent::with(['package:id,custom,items,total'])
                ->whereUserId($user->id)
                ->orderByDesc('id')
                ->get();

            $data['bills'] = [
                'total_bill' => $billQ->count(),
                'total_demand' => $billQ->sum('total'),
                'total_paid' => $billQ->sum('pay'),
                'total_fine' => $billQ->sum('fine'),
                'total_discount' => $billQ->sum('waiver'),
                'total_due' => $billQ->sum('due'),
                'complete_bill' => $billQ->where('isPaid',1)->count(),
                'last_paid_at' => $billQ->where('isPaid',1)->sortByDesc('updated_at')->first() ?$billQ->where('isPaid',1)->sortByDesc('updated_at')->first()->updated_at : '',
                'bills' => $billQ,
            ];


            return response()->json($data,200);

        }else{
            return response()->json(['error' => 'Student Not Find'],403);
        }
    }

    public function submitSpecificStudentBill(Request $request)
    {
        $request->validate([
            'user_id' => ['required'],
            'bill_id' => ['required','exists:bill_students,id'],
            'total' => ['required','numeric'],
            'pay' => ['required','numeric'],
            'waiver' => ['nullable','numeric'],
            'fine' => ['nullable','numeric'],
        ]);

        $bill = BillStudent::with('package:id,custom,total,items')->find($request->input("bill_id"));
        if ($bill) {

            $bill->fine = $request->input("fine")??0;
            $bill->waiver = $request->input("waiver")??0;
            $bill->pay = $bill->pay + $request->input("pay");
            $bill->receive_by = auth()->id();
            $bill->isAttempt = true;
            if ($request->input("due") == 'Paid') {
                $bill->due = 0;
                $bill->isPaid = true;
            }else{
                $bill->due = $request->input("due");
            }
            $bill->save();

            return response()->json($bill,200);
        }else{
            return response()->json(['error'=>'Bill Item not found'],403);
        }
    }

    public function specificBillReceipt(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric'
        ]);
        $bill = BillStudent::with('package:id,custom,total,items')->find($request->input("id"));
        if ($bill) {
            return response()->json($bill,200);
        }else{
            return response()->json(['error'=>'Bill Item not found'],403);
        }
    }
}
