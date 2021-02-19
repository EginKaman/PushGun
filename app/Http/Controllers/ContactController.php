<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function store(ContactStoreRequest $request)
    {
        $addressbook = Auth::user()->addressbooks()->where('id', $request->addressbook_id)->first();
        foreach ($request->contacts as $item) {
            $contact = new Contact;
            $contact->address = $item;
            $contact->addressbook()->associate($addressbook->id);
            $contact->save();
        }
        return response()->json([
            'message'=> __('Контакты добавлены')
        ]);
    }
}
