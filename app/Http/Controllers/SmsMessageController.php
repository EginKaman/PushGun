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
        $user = Auth::user();
        $smsMessage->user()->associate($user);
        $price = config('app.sms_price');
        if (isset($input['address_book_id'])) {
            $contactsCount = Contact::where('address_book_id', $input['address_book_id'])->count();
            if ($user->balance < $contactsCount * $price) {
                return response()->json([
                    'msg' => 'Недостаточно средств'
                ], 200);
            }
            $smsMessage->addressbook()->associate($input['address_book_id']);
        } else if (isset($input['contacts'])) {
            if ($user->balance < count($input['contacts']) * $price) {
                return response()->json([
                    'msg' => 'Недостаточно средств'
                ], 200);
            }
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
