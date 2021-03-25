<?php

namespace App\Http\Controllers;

use App\AddressBook;
use App\Http\Requests\AddressBookStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressBookController extends Controller
{
    public function index()
    {
        $addressbooks = Auth::user()->addressBooks()->withCount('contacts')->get();
        foreach ($addressbooks as $addressbook) {
            $addressbook->mailsCount = $addressbook->contacts()->where('is_email', true)->count();
            $addressbook->numbersCount = $addressbook->contacts()->where('is_email', false)->count();
        }
        return view('contact.index', [
            'addressbooks' => $addressbooks
        ]);
    }

    public function store(AddressBookStoreRequest $request)
    {
        $input = $request->validated();
        $addressbook = new AddressBook();
        $addressbook->user()->associate(Auth::user());
        $addressbook->name = $input['name'];
        $addressbook->save();
        return response()->json([
            'addressbook' => $addressbook
        ], 201);
    }
}
