<?php


namespace App\Helpers;

use App\EmailSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class EmailSettingChecker
{
    public static function checkSmtp($request)
    {
        $url = $request['smtp_host'];
        $username = $request['smtp_username'];
        $password = $request['smtp_password'];
        $port = $request['smtp_port'];
        $enc = $request['smtp_enc'];

        try{
            $transport = new \Swift_SmtpTransport($url, $port, $enc);
            $transport->setUsername($username);
            $transport->setPassword($password);
            $mailer = new \Swift_Mailer($transport);
            $mailer->getTransport()->start();
            return true;
        } catch (\Swift_TransportException $e) {
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function checkMailgun($request)
    {
        try {
            $email = EmailSetting::first();
            Config::set('mail.driver','mailgun');
            Config::set('services.mailgun.domain',$request['mailgun_domain']);
            Config::set('services.mailgun.secret',$request['mailgun_secret']);

            $mail_val = [
                'email' => $email->mail_from_address,
                'name' => $email->mail_from_name,
                'g_email' => 'hellomrhasan@gmail.com',
                'g_title' => 'Lead Developer @Softwarezon',
                'subject' => 'Mailgun Driver Checking',
            ];
            $body = '<h3>Hello, Author. <br>You receive this message for {{message}}.</h3>';
            $body = str_replace("{{message}}",'Checking Mailgun Driver',$body);

            Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
                $m->from($mail_val['g_email'], $mail_val['g_title']);
                $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
            });
            if (Mail::failures()) {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
