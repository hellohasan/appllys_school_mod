<?php

namespace App\Http\Controllers;

use App;
use App\Helpers\AppHelper;
use Illuminate\Http\Request;

class LanguageController extends Controller {

    /**
     * @param Request $request
     */
    public function changeLanguage(Request $request) {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        AppHelper::changeEnv(['APP_LANG' => (string) $request->lang]);

        return response()->json(['message' => 'Language Chnaged'], 200);
    }
}
