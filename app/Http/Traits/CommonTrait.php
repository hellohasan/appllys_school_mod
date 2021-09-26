<?php
namespace App\Http\Traits;

use Mpdf\Mpdf;
use Illuminate\Support\Str;
use App\Exports\CustomExport;
use Maatwebsite\Excel\Facades\Excel;

trait CommonTrait
{
    public function listPDFDownload($headings, $rows, $orientation = 'P')
    {
        $data['tableHead'] = $headings;
        $data['tableRows'] = $rows;

        $mPdf = new Mpdf([
            'default_font_size' => 12,
            'default_font'      => 'solaimanlipi',
            'orientation'       => $orientation,
        ]);
        $html = view('export.ListPDF', $data);
        $html = $html->render();
        $fileName = Str::random(5) . '.pdf';
        $mPdf->WriteHTML($html);
        $mPdf->Output($fileName, 'D');
    }

    public function listExcelDownload($heading, $rows, $title)
    {
        $myFile = Excel::raw(new CustomExport($heading, $rows, $title), \Maatwebsite\Excel\Excel::XLSX);

        return ['name' => $title, 'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($myFile)];
    }
}
