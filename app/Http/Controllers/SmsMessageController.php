<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\SmsMessageStoreRequest;
use App\Http\Resources\AddressBookResource;
use App\Http\Resources\AddressBooksResource;
use App\SmsMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmsMessageController extends Controller
{
    public function index()
    {
        $smsMessages = Auth::user()->smsMessages()->get();
    }

    public function store(SmsMessageStoreRequest $request)
    {
        $input = $request->validated();
        $smsMessage = new SmsMessage;
        $smsMessage->fill($input);
        $smsMessage->user()->associate(Auth::id());
        if (isset($input['address_book_id'])) {
            $smsMessage->addressbook()->associate($input['address_book_id']);
        }
        $smsMessage->save();
        if (isset($input['contacts'])) {
            foreach ($input['contacts'] as $number) {
                $contact = new Contact;
                $contact->address = $number;
                $contact->is_email = false;
                $contact->sms()->associate($smsMessage);
                $contact->save();
            }
        }
        $smsMessage->save();
        return response()->json(['msg' => 'created'], 201);
    }


    public function show($id)
    {
        $smsMessage = SmsMessage::findOrFail($id);
    }


    public function create()
    {
        $addressbooks = Auth::user()->addressbooks()->get();
        return view('email.sms', [
            'addressbooks' => new AddressBooksResource($addressbooks)
        ]);
    }
}
