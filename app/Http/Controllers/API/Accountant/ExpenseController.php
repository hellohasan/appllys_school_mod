<?php

namespace App\Http\Controllers\API\Accountant;

use App\Models\Account;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller {

    public function __construct() {
        $this->middleware('permission:expenses', ['only' => ['index']]);
        $this->middleware('permission:expenses-store', ['only' => ['store']]);
        $this->middleware('permission:expenses-edit', ['only' => ['edit']]);
        $this->middleware('permission:expenses-update', ['only' => ['update']]);
        $this->middleware('permission:expenses-delete', ['only' => ['destroy']]);
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
            "items"                => "required|array",
            "items.*.bill_item_id" => "required",
            "items.*.amount"       => "required|numeric",
            'total'                => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $expense = new Expense();
            $expense->custom = '1' . str_pad(Expense::orderByDesc('id')->first() ? Expense::orderByDesc('id')->first()->id : 0 + 1, 7, '0', STR_PAD_LEFT);
            $expense->total = $request->input("total");
            $expense->created_by = auth()->id();
            $expense->save();

            foreach ($request->items as $item) {
                $expense->items()->create($item);
            }

            $cash = Account::first();
            $expense->logs()->create([
                'user_id'       => auth()->id(),
                'account_id'    => $cash->id,
                'reason'        => 'expense',
                'before_amount' => $cash->amount,
                'amount'        => $expense->total,
                'type'          => 0, //minus from cash
                'after_amount'  => round($cash->amount - $expense->total, 2),
            ]);
            $cash->amount = round($cash->amount - $expense->total, 2);
            $cash->save();

            DB::commit();

            return response()->json(['custom' => $expense->custom], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong

            return response()->json(['error' => 'Something is wrong'], 503);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $custom
     * @return \Illuminate\Http\Response
     */
    public function show($custom) {
        return Expense::with([
            'items',
            'items.item:id,title',
        ])->whereCustom($custom)->firstOrFail();
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
