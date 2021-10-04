<?php

namespace App\Http\Controllers\API\Accountant;

use App\User;
use DataTables;
use Carbon\Carbon;
use App\Models\Salary;
use App\Models\Account;
use App\Models\SalaryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class SalaryController extends Controller {

    public function __construct() {
        $this->middleware('permission:salary', ['only' => ['index']]);
        $this->middleware('permission:salary-store', ['only' => ['store']]);
        $this->middleware('permission:salary-edit', ['only' => ['edit']]);
        $this->middleware('permission:salary-update', ['only' => ['update']]);
        $this->middleware('permission:salary-delete', ['only' => ['destroy']]);
    }

    /**
     * @param Request $request
     */
    public function salaryFinder(Request $request) {
        $request->validate([
            "role_id" => "required",
        ]);

        if ($request->input("role_id") == 'all') {
            $users = User::with([
                'roles:id,name',
                'salary:id,user_id,salary_scale_id',
                'salary.salary_scale:id,title,amount',
            ])
                ->whereHas('salary')
                ->select(['id', 'name'])
                ->get();

        } else {
            $role = Role::findById($request->input("role_id"));
            $users = User::role($role->name)->with([
                'roles:id,name',
                'salary:id,user_id,salary_scale_id',
                'salary.salary_scale:id,title,amount',
            ])
                ->whereHas('salary')
                ->select(['id', 'name'])
                ->get();

        }

        return response()->json($users, 200);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $salaries = Salary::with(['creator:id,name', 'role:id,name'])->orderByDesc('id')->get();

        return Datatables::of($salaries)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->toDateTimeString();
            })
            ->editColumn('created_by', function ($row) {
                return $row->creator->name;
            })
            ->editColumn('role_id', function ($row) {
                return $row->role->name . ' ' . __('Salary');
            })
            ->editColumn('total', function ($row) {
                return $row->total . ' ' . __('BDT');
            })
            ->addColumn('action', function ($row) {
                $btn = '<button data-id="' . $row->id . '" data-action="show" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> ' . __('show') . '</button> ';
                $btn .= '<button data-id="' . $row->id . '" data-action="delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> ' . __('delete') . '</button>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            "title"                 => "required",
            'salaries'              => 'required|array',
            'salaries.*.user_id'    => 'required',
            'salaries.*.account_id' => 'required',
            'salaries.*.amount'     => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $salary = new Salary();
            $salary->title = $request->input("title");
            $salary->total = $request->input("total");
            $salary->role_id = $request->input("role_id") == 'all' ? null : $request->input("role_id");
            $salary->created_by = auth()->id();
            $salary->save();

            foreach ($request->input('salaries') as $item) {
                $log = SalaryLog::orderByDesc('id')->select('id')->first();
                $salary->salaries()->create([
                    'custom'          => '1' . str_pad(($log ? $log->id : 1) + 1, 7, '0', STR_PAD_LEFT),
                    'user_id'         => $item['user_id'],
                    'salary_scale_id' => $item['scale_id'],
                    'account_id'      => $item['account_id'],
                    'amount'          => $item['amount'],
                ]);

                $account = Account::find($item['account_id']);
                $salary->logs()->create([
                    'user_id'       => auth()->id(),
                    'account_id'    => $account->id,
                    'reason'        => 'salary',
                    'before_amount' => $account->amount,
                    'amount'        => $item['amount'],
                    'type'          => 0, //minus from account
                    'after_amount'  => round($account->amount - $item['amount'], 2),
                ]);
                $account->amount = round($account->amount - $item['amount'], 2);
                $account->save();
            }
            DB::commit();

            return response()->json(['salary_id' => $salary->id], 200);

        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong

            return response()->json('somethinh wrong there', 503);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $salary = Salary::with([
            'creator',
            'role',
            'salaries',
            'salaries.user',
            'salaries.scale',
            'salaries.account',
        ])->findOrFail($id);

        return $salary;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $salary = Salary::findOrFail($id);

        foreach ($salary->salaries as $item) {
            $account = Account::find($item->account_id);
            $salary->logs()->create([
                'user_id'       => auth()->id(),
                'account_id'    => $account->id,
                'reason'        => 'salary_reverse',
                'before_amount' => $account->amount,
                'amount'        => $item->amount,
                'type'          => 1, //minus from account
                'after_amount'  => round($account->amount + $item->amount, 2),
            ]);
            $account->amount = round($account->amount + $item->amount, 2);
            $account->save();
            $item->delete();
        }

        $salary->delete();

        return response()->json('Done', 200);

    }
}
