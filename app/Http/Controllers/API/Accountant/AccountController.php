<?php

namespace App\Http\Controllers\API\Accountant;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Account::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            "name"         => "required",
            'amount'       => 'required|numeric',
            'bank_account' => 'required',
            'bank_branch'  => 'required',
        ]);

        $bank = new Account();
        $bank->name = $request->input("name");
        $bank->amount = $request->input("amount");
        $bank->created_by = auth()->id();
        $bank->updated_by = auth()->id();
        $bank->isActive = $request->input("isActive") == 'on' ? true : false;
        $bank->bank_account = $request->input("bank_account");
        $bank->bank_branch = $request->input("bank_branch");
        $bank->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $bank = Account::findOrFail($id);

        $request->validate([
            "name"         => "required",
            'amount'       => 'required|numeric',
            'bank_account' => 'required',
            'bank_branch'  => 'required',
        ]);

        $bank->name = $request->input("name");
        $bank->amount = $request->input("amount");
        $bank->updated_by = auth()->id();
        $bank->isActive = $request->input("isActive") == 'on' ? true : false;
        $bank->bank_account = $request->input("bank_account");
        $bank->bank_branch = $request->input("bank_branch");
        $bank->save();

    }

}
