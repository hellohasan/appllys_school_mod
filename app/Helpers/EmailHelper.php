<?php


namespace App\Helpers;


use App\BasicSetting;
use App\EmailSetting;
use App\PaymentLog;
use App\User;
use Illuminate\Support\Facades\Mail;

class EmailHelper
{
    public function paymentConfirm($data)
    {
        $email = EmailSetting::first();
        $basic = BasicSetting::first();

        $user = User::findOrFail($data->user_id);
        $mail_val = [
            'email' => $user->email,
            'name' => $user->name,
            'g_email' => $email->mail_from_address,
            'g_title' => $email->mail_from_name,
            'subject' => "Course purchase Completed",
        ];

        $urText = 'Course Payment Successfully Confirmed : '.$data->usd.' '.$basic->currency.' via - '.$data->paymentMethod->name.' <br> Transaction Number Is : '.$data->order_number.'<br>';
        $body = $email->mail_template;
        $body = str_replace("{{name}}",$user->name,$body);
        $body = str_replace("{{message}}",$urText,$body);
        $body = str_replace("{{site_title}}",$basic->title,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });
    }

    public function manualPaymentEmail($userId, $logId)
    {
        $user = User::find($userId);
        $log = PaymentLog::find($logId);
        $basic = BasicSetting::first();
        $email = EmailSetting::first();

        $method = $log->paymentMethod->name;
        $amount = $log->amount . ' ' . $basic->currency;
        $mail_val = [
            'email' => $user->email,
            'name' => $user->name,
            'g_email' => $email->mail_from_address,
            'g_title' => $email->mail_from_name,
            'subject' => "Payment Request Receive - " . $basic->title,
        ];
        $text = "<b>We received your payment request.our finance department will check it as soon as possible.</b><br><br>";
        $text .= "<b>Selected Method : $method</b><br>";
        $text .= "<b>Total Amount : $amount</b>";
        $body = $email->mail_template;
        $body = str_replace("{{name}}", $user->name, $body);
        $body = str_replace("{{message}}", $text, $body);
        $body = str_replace("{{site_title}}", $basic->title, $body);

        Mail::send('emails.email', ['body' => $body], function ($m) use ($mail_val) {
            $m->from($mail_val['g_email'], $mail_val['g_title']);
            $m->to($mail_val['email'], $mail_val['name'])->subject($mail_val['subject']);
        });
    }

    public function sendContact($email,$name,$subject,$text,$phone)
    {
        $em = EmailSetting::first();
        $basic = BasicSetting::first();

        $mail_val = [
            'email' => $email,
            'name' => $name,
            'g_email' => $basic->email,
            'g_title' => $basic->title,
            'subject' => '[Contact Message] - '.$subject,
        ];

        $body = $em->mail_template;

        $body = str_replace("Hi",'Hi. I\'m',$body);
        $body = str_replace("{{name}}",$name." - ".$phone,$body);
        $body = str_replace("{{message}}",$text,$body);
        $body = str_replace("{{site_title}}",$basic->title,$body);

        Mail::send('emails.email', ['body'=>$body], function ($m) use ($mail_val) {
            $m->from($mail_val['email'], $mail_val['name']);
            $m->to($mail_val['g_email'], $mail_val['g_title'])->subject($mail_val['subject']);
        });
    }
}
