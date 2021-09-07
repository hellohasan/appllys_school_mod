<?php

namespace App\Http\Controllers;

use App\Models\BillItem;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layouts.master');
    }

    public function helperURL(){
        $user = User::findOrFail(2);
        Permission::create(['name'=>'posts.*']);
        $user->givePermissionTo('posts.*');

        echo 'Done';
    }

    public function exportPDF(Request $request)
    {

        $data['tableHead'] = [
            'ID','Title','Bill For','Default Amount','Status'
        ];
        $tableRows = [];
        $billItems = BillItem::get();
        foreach ($billItems as  $bill){
            $tableRows[] = [
                $bill->id,
                $bill->title,
                $bill->item_for,
                $bill->default_amount,
                $bill->activated
            ];
        }

        $data['tableRows'] = $tableRows;

        return view('export.exportPDF',$data);



        $data = [
            'name' => 'আমি কি চাই আমি নিজেই জানি না।'
        ];
        $mPdf = new \Mpdf\Mpdf([
            'default_font_size' => 12,
            'default_font' => 'solaimanlipi'
        ]);

        $html = view('export.exportPDF', $data);
        $html = $html->render();
        $fileName = Str::random(5).'Tabulation.pdf';
        $mPdf->WriteHTML($html);
        $mPdf->Output($fileName,'D');


        /*$pdf = PDF::loadView('export.exportPDF', $data, [], [
            'title' => 'Another Title',
            'default_font' => 'Nikosh'
        ]);
        $fileName = Str::random(5).'Tabulation.pdf';
        return $pdf->stream($fileName);*/
    }

    public function pdfData()
    {
        return 'আমি কি চাই আমি নিজেই জানি না।';
    }
}
