<?php

namespace App\Http\Controllers\API\Accountant;

use App\User;
use Carbon\Carbon;
use App\Models\Account;
use App\Models\BillStudent;
use App\Models\AcademicData;
use Illuminate\Http\Request;
use App\Models\TransactionLog;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class BillReceiveController extends Controller {
    /**
     * @param Request $request
     */
    public function receiveSpecificStudentBill(Request $request) {
        $request->validate([
            'id' => 'required',
        ]);

        $user = User::with([
            'father', 'mother', 'guardian.guardianInformation', 'address',
        ])->role('Student')->find($request->input("id"));

        if ($user) {
            $academicData = AcademicData::orderByDesc('academic_session_id')->whereUserId($user->id)->first();
            $data['academic_data'] = $academicData->academic_data;
            $data['student_data'] = [
                'name'  => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'photo' => asset($user->photo),
            ];
            $father = $user->father;
            $mother = $user->mother;
            $guardian = $user->guardian->guardianInformation;
            $data['guardian_data'] = [
                'father_name'      => $father[0]->name,
                'father_name_bn'   => $father[0]->name_bn,
                'father_phone'     => $father[0]->phone,
                'father_image'     => asset($father[0]->image),
                'mother_name'      => $mother[0]->name,
                'mother_name_bn'   => $mother[0]->name_bn,
                'mother_phone'     => $mother[0]->phone,
                'mother_image'     => asset($mother[0]->image),
                'guardian_name'    => $guardian->name,
                'guardian_name_bn' => $guardian->name_bn,
                'guardian_phone'   => $guardian->phone,
                'guardian_image'   => asset($guardian->image),
            ];

            $billQ = BillStudent::with(['package:id,items,total'])
                ->whereUserId($user->id)
                ->orderByDesc('id')
                ->get();

            $data['bills'] = [
                'total_bill'     => $billQ->count(),
                'total_demand'   => $billQ->sum('total'),
                'total_paid'     => $billQ->sum('pay'),
                'total_fine'     => $billQ->sum('fine'),
                'total_discount' => $billQ->sum('waiver'),
                'total_due'      => $billQ->sum('due'),
                'complete_bill'  => $billQ->where('isPaid', 1)->count(),
                'last_paid_at'   => $billQ->where('isPaid', 1)->sortByDesc('updated_at')->first() ? $billQ->where('isPaid', 1)->sortByDesc('updated_at')->first()->updated_at : '',
                'bills'          => $billQ,
            ];

            return response()->json($data, 200);

        } else {
            return response()->json(['error' => 'Student Not Find'], 403);
        }
    }

    /**
     * @param Request $request
     */
    public function submitSpecificStudentBill(Request $request) {
        $request->validate([
            'user_id' => ['required'],
            'bill_id' => ['required'],
            'total'   => ['required', 'numeric'],
            'pay'     => ['required', 'numeric'],
            'waiver'  => ['nullable', 'numeric'],
            'fine'    => ['nullable', 'numeric'],
        ]);

        $bill = BillStudent::with('package:id,total,items')->find($request->input("bill_id"));
        if ($bill) {

            try {
                DB::beginTransaction();

                $bill->fine = $request->input("fine") ?? 0;
                $bill->waiver = $request->input("waiver") ?? 0;
                $bill->pay = $bill->pay + $request->input("pay");
                $bill->receive_by = auth()->id();
                $bill->isAttempt = true;
                if ($request->input("due") == 'Paid') {
                    $bill->due = 0;
                    $bill->isPaid = true;
                } else {
                    $bill->due = $request->input("due");
                }
                $bill->save();

                $cash = Account::first();
                $bill->logs()->create([
                    'user_id'       => auth()->id(),
                    'account_id'    => $cash->id,
                    'reason'        => 'bill_receive',
                    'before_amount' => $cash->amount,
                    'amount'        => $request->input("pay"),
                    'type'          => 1, //add to cash
                    'after_amount'  => round($cash->amount + $request->input("pay"), 2),
                ]);
                $cash->amount = round($cash->amount + $request->input("pay"), 2);
                $cash->save();

                DB::commit();

                return response()->json($bill, 200);
            } catch (\Exception $e) {
                DB::rollback();

                return response()->json(['error' => 'Something Wrong there'], 503);
            }
        } else {
            return response()->json(['error' => 'Bill Item not found'], 403);
        }
    }

    /**
     * @param Request $request
     */
    public function specificBillReceipt(Request $request) {
        $request->validate([
            'id' => 'required|numeric',
        ]);
        $bill = BillStudent::with('package:id,custom,total,items')->find($request->input("id"));
        if ($bill) {
            return response()->json($bill, 200);
        } else {
            return response()->json(['error' => 'Bill Item not found'], 403);
        }
    }

    /**
     * @return mixed
     */
    public function loadBillPayList() {

        $log = TransactionLog::select('id', 'logable_type', 'logable_id', 'reason', 'amount', 'created_at')
            ->with([
                'logable:id,user_id,custom,bill_package_id',
                'logable.package:id,academic_class_id',
                'logable.package.academic_class:id,name',
                'logable.user:id,name',
            ])->whereReason('bill_receive')
            ->orderByDesc('id')
            ->get();

        return DataTables::of($log)
            ->addIndexColumn()
            ->addColumn('custom', function ($row) {
                return $row->logable->custom;
            })
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('dS-M-Y');
            })
            ->addColumn('academic_class', function ($row) {
                return $row->logable->package->academic_class->name;
            })
            ->editColumn('amount', function ($row) {
                return $row->amount . ' ' . trans('lang.BDT');
            })
            ->addColumn('name', function ($row) {
                return $row->logable->user->name;
            })
            ->addColumn('action', function ($row) {
                return '<button data-id="' . $row->id . '" data-action="delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> ' . __('delete') . '</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @param Request $request
     */
    public function deleteBillPayList(Request $request) {
        $request->validate([
            "id" => "required",
        ]);

        $log = TransactionLog::findOrFail($request->input("id"));
        $bill = $log->logable;
        $bill->pay = round($bill->pay - $log->amount, 2);
        $bill->due = round($bill->due + $log->amount, 2);
        $bill->isPaid = false;
        $bill->save();

        $cash = Account::first();
        $cash->amount = round($cash->amount - $log->amount, 2);
        $cash->save();
        $log->delete();

        return response()->json(['message' => 'Deleted'], 200);
    }
}
