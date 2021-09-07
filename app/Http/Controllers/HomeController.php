<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use PDF;

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

        $pdf = PDF::loadView('export.exportPDF', [], [], [
            'title' => 'Another Title',
            'default_font' => 'Nikosh'
        ]);
        $fileName = Str::random(5).'Tabulation.pdf';
        return $pdf->stram($fileName);
    }
}
