<?php

namespace App\Http\Controllers\API\Accountant;

use App\User;
use App\Models\Salary;
use App\Models\Account;
use App\Models\SalaryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class SalaryController extends Controller {

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
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
