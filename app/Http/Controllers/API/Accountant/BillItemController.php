<?php

namespace App\Http\Controllers\Api\Accountant;

use App\Exports\CustomExport;
use App\Http\Controllers\Controller;
use App\Models\BillItem;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

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

    public function exportExcel(Request $request)
    {
        $items = BillItem::get();
        $rows = [];
        $heading = ['Title', 'Default Amount'];
        $title = "Bill Item Lists";
        foreach ($items as $item) {
            $rows[] = [
                'Title' => $item->title,
                'Default Amount' => $item->default_amount,
            ];
        }

        $myFile = Excel::raw(new CustomExport($heading, $rows, $title), \Maatwebsite\Excel\Excel::XLSX);
        $response = array('name' => $title, 'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($myFile));
        return response()->json($response);
    }

    public function exportPDF(Request $request)
    {

        $data = [
            'foo' => 'bar'
        ];

        $pdf = PDF::setPaper('a4', 'landscape')->loadView('export.exportPDF')
            ->setPaper('a4', 'landscape')
            ->setWarnings(false);
        return $pdf->download('invoice.pdf');



        /*$data = [
            'foo' => 'bar'
        ];

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,])->loadView('export.exportPDF', $data);
        $fileName = 'Tabulation.pdf';
        return $pdf->download($fileName);*/


        /*$mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 12,
            'default_font' => 'nikosh'
        ]);

        $data = [
            'foo' => 'bar'
        ];

        $html = view('export.exportPDF',[
            'data' => $data
        ]);

        $html = $html->render();
        //$mpdf->WriteHTML($bootstrap,1);
        $mpdf->WriteHTML($html);
        $mpdf->Output('document','I');*/

        /*$config = [
            'default_font_size' => 12,
            'default_font' => 'solaimanlipi'
        ];
        $data = [
            'foo' => 'bar'
        ];
        $pdf = PDF::loadView('export.exportPDF', $data, [], $config);
        return $pdf->stream('document.pdf');*/


        /*$font_family = "'kalpurush','sans-serif'";
        $config = [
            'format'           => 'A4',
            'display_mode'     => 'fullpage',
            'orientation' => 'landscape',
            'font_path' => public_path('fonts'),
        ];

        $data = [
            'order' =>  BillItem::get(),
            'font_family' => $font_family,
        ];
        $temp = 'export.exportPDF';
        $mode = 'portrait';
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,])->loadView($temp,$data )->setPaper('a4', $mode);
        return $pdf->download('fff.pdf');*/
    }

    public function mydata()
    {
        return 'মাই হইলাম হাসান সাহেব Hasan Rhaman';
    }
}
