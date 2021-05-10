<?php

namespace App\Http\Controllers;

use App\Mail\SendMailToPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        $detail = [
            'title' => 'Informasi Agenda',
            'body' => 'Assalamualaikum, anda memiliki agenda....'
        ];
        Mail::to('yusuf.dputra0@gmail.com')->send(new SendMailToPegawai($detail));
        return 'Terkirim';
    }
}
