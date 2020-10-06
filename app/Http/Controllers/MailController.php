<?php

namespace App\Http\Controllers;

use App\Mail\Question;
use App\Http\Requests\Question as QuestionRequest;
use App\Http\Requests\Support as SupportRequest;
use App\Mail\Support;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function support(SupportRequest $request)
    {
        Mail::to(config('mail.from.address'))->send(new Support($request->name, $request->email, $request->message));
        return response()->json([
            'message' => __('Спасибо! Ваша заявка принята, мы скоро свяжемся с вами.')
        ]);
    }

    public function question(QuestionRequest $request)
    {
        Mail::to(config('mail.from.address'))->send(new Question($request->name, $request->email, $request->message));
        return response()->json([
            'message' => __('Спасибо! Ваша заявка принята, мы скоро свяжемся с вами.')
        ]);
    }
}
