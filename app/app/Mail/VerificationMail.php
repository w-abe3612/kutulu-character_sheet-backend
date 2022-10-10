<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $token;
    protected $verifyRoute = 'verify';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        // 引数でトークンを受け取る
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // 件名
        $subject = 'Verification mail';

        $baseUrl = config('app.front');
        $token = $this->token;
        $url = "{$baseUrl}/register/verify/?token={$token}";

        // 送信元のアドレス
        $from = config('mail.from.address');

        // メール送信
        return $this
            ->from($from)
            ->subject($subject)
            // 送信メールのビュー
            ->view('mails.verification_mail')
            // ビューで使う変数を渡す
            ->with('url', $url);
    }
}
