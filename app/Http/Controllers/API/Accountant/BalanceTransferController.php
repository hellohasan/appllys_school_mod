<?php

namespace App\Http\Controllers\API\Accountant;

use DataTables;
use Carbon\Carbon;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\BalanceTransfer;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BalanceTransferController extends Controller {

    public function __construct() {
        $this->middleware('permission:balance-transfer', ['only' => ['index']]);
        $this->middleware('permission:balance-transfer-store', ['only' => ['store']]);
        $this->middleware('permission:balance-transfer-edit', ['only' => ['edit']]);
        $this->middleware('permission:balance-transfer-update', ['only' => ['update']]);
        $this->middleware('permission:balance-transfer-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = BalanceTransfer::with(['sender_account:id,name', 'receive_account:id,name'])->orderByDesc('id')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->toDateTimeString();
            })
            ->editColumn('from_account_id', function ($row) {
                return $row->sender_account->name;
            })
            ->editColumn('to_account_id', function ($row) {
                return $row->receive_account->name;
            })
            ->editColumn('amount', function ($row) {
                return $row->amount . ' ' . __('BDT');
            })
            ->editColumn('from_charge', function ($row) {
                return $row->from_charge . ' ' . __('BDT');
            })
            ->editColumn('from_total', function ($row) {
                return $row->from_total . ' ' . __('BDT');
            })
            ->editColumn('to_charge', function ($row) {
                return $row->to_charge . ' ' . __('BDT');
            })
            ->editColumn('to_total', function ($row) {
                return $row->to_total . ' ' . __('BDT');
            })
            ->addColumn('action', function ($row) {
                $btn = '<button data-id="' . $row->custom . '" data-action="show" class="btn btn-sm btn-success"><i class="fas fa-eye"></i> ' . __('show') . '</button> ';
                $btn .= '<button data-id="' . $row->custom . '" data-action="delete" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> ' . __('delete') . '</button>';

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
            'from_account_id' => 'required',
            'amount'          => 'required|numeric',
            'from_charge'     => 'nullable|numeric',
            'from_total'      => 'required|numeric',
            'to_account_id'   => 'required',
            'to_charge'       => 'nullable|numeric',
            'to_total'        => 'required|numeric',
        ]);

        try {
            DB::beginTransaction();

            $in = $request->all();
            $in['created_by'] = auth()->id();
            $balanceTransfer = BalanceTransfer::create($in);
            $balanceTransfer->custom = custom($balanceTransfer->id);
            $balanceTransfer->save();

            $formAccount = Account::find($request->input("from_account_id"));

            $balanceTransfer->logs()->create([
                'user_id'       => auth()->id(),
                'account_id'    => $formAccount->id,
                'reason'        => 'transfer_from',
                'before_amount' => $formAccount->amount,
                'amount'        => $balanceTransfer->amount,
                'type'          => 0, //minus from account
                'after_amount'  => customRound($formAccount->amount - $balanceTransfer->amount),
            ]);
            $formAccount->amount = customRound($formAccount->amount - $balanceTransfer->amount);
            $formAccount->save();

            if ($balanceTransfer->from_charge != 0) {
                $balanceTransfer->logs()->create([
                    'user_id'       => auth()->id(),
                    'account_id'    => $formAccount->id,
                    'reason'        => 'transfer_from_charge',
                    'before_amount' => $formAccount->amount,
                    'amount'        => $balanceTransfer->from_charge,
                    'type'          => 0, //minus from account
                    'after_amount'  => customRound($formAccount->amount - $balanceTransfer->from_charge),
                ]);
                $formAccount->amount = customRound($formAccount->amount - $balanceTransfer->from_charge);
                $formAccount->save();
            }

            $receiveAccount = Account::find($request->input("to_account_id"));

            $balanceTransfer->logs()->create([
                'user_id'       => auth()->id(),
                'account_id'    => $receiveAccount->id,
                'reason'        => 'transfer_to',
                'before_amount' => $receiveAccount->amount,
                'amount'        => $balanceTransfer->amount,
                'type'          => 1, //add from account
                'after_amount'  => customRound($receiveAccount->amount + $balanceTransfer->amount),
            ]);
            $receiveAccount->amount = customRound($receiveAccount->amount + $balanceTransfer->amount);
            $receiveAccount->save();

            if ($balanceTransfer->to_charge != 0) {
                $balanceTransfer->logs()->create([
                    'user_id'       => auth()->id(),
                    'account_id'    => $receiveAccount->id,
                    'reason'        => 'transfer_to_charge',
                    'before_amount' => $receiveAccount->amount,
                    'amount'        => $balanceTransfer->to_charge,
                    'type'          => 0, //minus from account
                    'after_amount'  => customRound($receiveAccount->amount - $balanceTransfer->to_charge),
                ]);
                $receiveAccount->amount = customRound($receiveAccount->amount - $balanceTransfer->to_charge);
                $receiveAccount->save();
            }

            DB::commit();

            return response()->json(['message' => 'Successfully Accepted', 'custom' => $balanceTransfer->custom], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => 'Something is wrong there'], 503);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return BalanceTransfer::with([
            'sender_account:id,name',
            'receive_account:id,name',
            'creator:id,name',
        ])->whereCustom($id)->firstOrFail();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $balanceTransfer = BalanceTransfer::whereCustom($id)->firstOrFail();

        try {
            DB::beginTransaction();

            $formAccount = Account::find($balanceTransfer->from_account_id);

            $balanceTransfer->logs()->create([
                'user_id'       => auth()->id(),
                'account_id'    => $formAccount->id,
                'reason'        => 'transfer_from_reverse',
                'before_amount' => $formAccount->amount,
                'amount'        => $balanceTransfer->amount,
                'type'          => 1, //add to account
                'after_amount'  => customRound($formAccount->amount + $balanceTransfer->amount),
            ]);
            $formAccount->amount = customRound($formAccount->amount + $balanceTransfer->amount);
            $formAccount->save();

            if ($balanceTransfer->from_charge != 0) {
                $balanceTransfer->logs()->create([
                    'user_id'       => auth()->id(),
                    'account_id'    => $formAccount->id,
                    'reason'        => 'transfer_from_charge_reverse',
                    'before_amount' => $formAccount->amount,
                    'amount'        => $balanceTransfer->from_charge,
                    'type'          => 1, //add to account
                    'after_amount'  => customRound($formAccount->amount + $balanceTransfer->from_charge),
                ]);
                $formAccount->amount = customRound($formAccount->amount + $balanceTransfer->from_charge);
                $formAccount->save();
            }

            $receiveAccount = Account::find($balanceTransfer->to_account_id);

            $balanceTransfer->logs()->create([
                'user_id'       => auth()->id(),
                'account_id'    => $receiveAccount->id,
                'reason'        => 'transfer_to_reverse',
                'before_amount' => $receiveAccount->amount,
                'amount'        => $balanceTransfer->amount,
                'type'          => 0, //minus from account
                'after_amount'  => customRound($receiveAccount->amount - $balanceTransfer->amount),
            ]);
            $receiveAccount->amount = customRound($receiveAccount->amount - $balanceTransfer->amount);
            $receiveAccount->save();

            if ($balanceTransfer->to_charge != 0) {
                $balanceTransfer->logs()->create([
                    'user_id'       => auth()->id(),
                    'account_id'    => $receiveAccount->id,
                    'reason'        => 'transfer_to_charge_reverse',
                    'before_amount' => $receiveAccount->amount,
                    'amount'        => $balanceTransfer->to_charge,
                    'type'          => 1, //add to account
                    'after_amount'  => customRound($receiveAccount->amount + $balanceTransfer->to_charge),
                ]);
                $receiveAccount->amount = customRound($receiveAccount->amount + $balanceTransfer->to_charge);
                $receiveAccount->save();
            }

            $balanceTransfer->delete();

            DB::commit();

            return response()->json(['message' => 'Successfully Accepted'], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['message' => 'Something is wrong there'], 503);
        }
    }
}
