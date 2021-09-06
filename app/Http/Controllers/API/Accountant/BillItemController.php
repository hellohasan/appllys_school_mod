<?php

namespace App\Http\Controllers\Api\Accountant;

use App\Exports\CustomExport;
use App\Http\Controllers\Controller;
use App\Models\BillItem;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BillItemController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return BillItem::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportExcel(Request $request)
    {
        $items = BillItem::get();
        $rows = [];
        $heading = ['Title','Default Amount'];
        $title = "Bill Item Lists";
        foreach ($items as $item){
            $rows[] = [
                'Title' => $item->title,
                'Default Amount' => $item->default_amount,
            ];
        }

        $myFile = Excel::raw(new CustomExport($heading,$rows,$title), \Maatwebsite\Excel\Excel::XLSX);
        $response =  array(
            'name' => $title,
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
        );
        return response()->json($response);
    }
}
