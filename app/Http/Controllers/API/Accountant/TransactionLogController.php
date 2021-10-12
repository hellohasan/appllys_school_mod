<?php

namespace App\Http\Controllers\API\Accountant;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TransactionLog;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class TransactionLogController extends Controller {
    public function __construct() {
        $this->middleware('permission:transaction-logs', ['only' => ['index']]);
    }

    /**
     * @return mixed
     */
    public function index(Request $request) {

        $data = TransactionLog::query();

        if ($request->input('daterange')) {
            $start = Carbon::createFromFormat('D M d Y H:i:s \G\M\TO', trim(str_replace("(Bangladesh Standard Time)", "", $request->input('daterange')[0])))->toDateString();
            $end = Carbon::createFromFormat('D M d Y H:i:s \G\M\TO', trim(str_replace("(Bangladesh Standard Time)", "", $request->input('daterange')[1])))->toDateString();
            $data->whereBetween('created_at', [
                Carbon::parse($start)->startOfDay(),
                Carbon::parse($end)->endOfDay(),
            ]);
        }

        if ($request->input('reason')) {
            $data->whereReason($request->input("reason"))
                ->orWhere('reason', $request->input("reason") . '_reverse');
        }

        $data = $data->with([
            'creator:id,name',
        ])->orderBy('id', 'desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->toDateTime();
            })
            ->editColumn('user_id', function ($row) {
                return $row->creator->name;
            })
            ->editColumn('reason', function ($row) {
                return Str::ucfirst(str_replace('_', ' ', $row->reason));
            })
            ->editColumn('type', function ($row) {
                return $row->type ? "(+) " . __('Credit') : "(-) " . __('Debit');
            })
            ->editColumn('before_amount', function ($row) {
                return $row->before_amount . ' ' . __('BDT');
            })
            ->editColumn('amount', function ($row) {
                return $row->amount . ' ' . __('BDT');
            })
            ->editColumn('after_amount', function ($row) {
                return $row->after_amount . ' ' . __('BDT');
            })
            ->make(true);
    }
}
