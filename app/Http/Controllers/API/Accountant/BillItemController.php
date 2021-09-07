<?php

namespace App\Http\Controllers\Api\Accountant;

use App\Exports\CustomExport;
use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\BillItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class BillItemController extends Controller
{
    use CommonTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BillItem::orderByDesc('id')->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:190',
            'item_for' => 'required',
            'default_amount' => 'required|numeric',
        ]);

        $in = $request->all();
        $in['activated'] = $request->input("activated") == 'on';
        BillItem::create($in);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return BillItem::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = BillItem::find($id);
        $request->validate([
            'title' => 'required|max:190',
            'item_for' => 'required',
            'default_amount' => 'required|numeric',
        ]);

        $in = $request->all();
        $in['activated'] = $request->input("activated") == 'on';
        $item->update($in);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportExcelPDF(Request $request)
    {
        if ($request->has('type')) {
            $type = $request->input("type");
            $title = 'Billing Item List';
            $headings = [
                'ID', 'Title', 'Bill For', 'Default Amount', 'Status'
            ];
            $rows = [];
            $billItems = BillItem::get();
            foreach ($billItems as $bill) {
                $rows[] = [
                    $bill->id,
                    $bill->title,
                    $bill->item_for,
                    $bill->default_amount,
                    $bill->activated ? 'Activated' : 'Deactivated'
                ];
            }
            if ($type == 'excel') {
                return response()->json($this->listExcelDownload($headings, $rows, $title));
            }elseif ($type == 'pdf') {
                $this->listPDFDownload($headings,$rows);
            }

        }
    }

}
