<?php

namespace App\Http\Controllers;

use App\AddressBook;
use App\Exports\AddressBookExport;
use App\Http\Requests\AddressBookStoreRequest;
use App\Http\Requests\ExportAddressbookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportAddressbook(ExportAddressbookRequest $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $input = $request->validated();
        $addressbook = AddressBook::findOrFail($input['id']);
        return Excel::download(new AddressBookExport($addressbook), 'addressbook.xlsx');
    }
}
