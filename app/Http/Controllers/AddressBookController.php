<?php

namespace App\Http\Controllers;

use App\AddressBook;
use App\Http\Requests\AddressBookStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressBookController extends Controller
{
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
