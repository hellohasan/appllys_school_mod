<?php

namespace App\Http\Controllers\API;

use App\Models\EmailSetting;
use App\Helpers\AppHelper;
use App\Helpers\EmailSettingChecker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;

class EmailSettingController extends Controller
{
    public function getEmailSetting()
    {
        return EmailSetting::first();
    }

    public function updateEmailSetting(Request $request)
    {
        $request->validate([
            "sender_name" => "required|max:100",
            "sender_email" => 'required|email|max:100',
            'mail_driver' => 'required',
            'smtp_host' => 'required_if:mail_driver,smtp',
            'smtp_port' => 'required_if:mail_driver,smtp',
            'smtp_username' => 'required_if:mail_driver,smtp',
            'smtp_password' => 'required_if:mail_driver,smtp',
            'smtp_enc' => 'required_if:mail_driver,smtp',
        ]);

        $email = EmailSetting::first();
        $in = $request->all();
        $email->update($in);

        if ($email->mail_driver === 'smtp') {
            if (EmailSettingChecker::checkSmtp($request->input())){
                AppHelper::changeEnv([
                    'MAIL_MAILER' => 'smtp',
                    'MAIL_HOST' => $email->smtp_host,
                    'MAIL_PORT' => $email->smtp_port,
                    'MAIL_USERNAME' => $email->smtp_username,
                    'MAIL_PASSWORD' => $email->smtp_password,
                    'MAIL_ENCRYPTION' => $email->smtp_enc,
                    'MAIL_FROM_ADDRESS' => $email->sender_email,
                    'MAIL_FROM_NAME' => $email->sender_name,
                ]);
            }else{
                return Response::json('Something went to wrong',503);
            }
        }else{
            AppHelper::changeEnv([
                'MAIL_MAILER' => 'mail',
                'MAIL_FROM_ADDRESS' => $email->sender_email,
                'MAIL_FROM_NAME' => $email->sender_name,
            ]);
        }
        Artisan::call('config:clear');
        return Response::json('Successfully updated',200);

    }

    public function getEmailTemplate()
    {
        $email = EmailSetting::first();
        return Response::json($email->email_template,200);
    }

    public function updateEmailTemplate(Request $request)
    {
        $request->validate([
            "content" => "required",
        ]);
        $email = EmailSetting::first();
        $email->email_template = $request->input("content");
        $email->save();

    }

}
