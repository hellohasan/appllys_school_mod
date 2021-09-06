<?php

namespace App\Http\Controllers\API;

use App\Models\BasicSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmsSettingController extends Controller
{
    public function getSMApiSetting()
    {
        return BasicSetting::select('sms_api')->first();
    }

    public function updateSMApiSetting(Request $request)
    {
        $request->validate([
            "sms_api" => "required",
        ]);
        $basic = BasicSetting::first();
        $basic->sms_api = $request->input("sms_api");
        $basic->save();
    }
}
