<?php

namespace App\Http\Controllers;

use App\EmailSender;
use App\Exports\EmailSenderExport;
use App\Http\Requests\EmailSenderStoreRequest;
use App\Http\Requests\EmailSenderUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class EmailSenderController extends Controller
{
    public function index(Request $request)
    {
    }
    public function store(EmailSenderStoreRequest $request)
    {
        $input = $request->validated();
        $emailSender = new EmailSender;
        $emailSender->fill($input);
        $emailSender->user()->associate(Auth::id());
        $emailSender->save();
        return response()->json(
            [
                'emailSender' => $emailSender
            ],
            201
        );
    }
    public function update($id, EmailSenderUpdateRequest $request)
    {
        $emailSender = Auth::user()->emailSenders()->findOrFail($id);
        $input = $request->validated();
    }

    public function exportEmailSenders(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $emailSenders = Auth::user()->emailSenders()->get();
        return Excel::download(new EmailSenderExport($emailSenders), 'emailsender.xlsx');
    }
}
