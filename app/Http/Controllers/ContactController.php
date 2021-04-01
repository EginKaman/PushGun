<?php

namespace App\Http\Controllers;

use App\AddressBook;
use App\Contact;
use App\Http\Requests\AddressBookFilterRequest;
use App\Http\Requests\ContactDestroyRequest;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Resources\AddressBookResource;
use App\Http\Resources\AddressBooksResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AddressBookFilterRequest $request)
    {
        $input = $request->validated();
        $addressBooks = Auth::user()->addressBooks()->withCount('contacts')->filter($input)->get();
        foreach ($addressBooks as $addressbook) {
            $addressbook->mailsCount = $addressbook->contacts()->where('is_email', true)->count();
            $addressbook->numbersCount = $addressbook->contacts()->where('is_email', false)->count();
        }
        return view('contact.index', [
            'addressBooks' => new AddressBooksResource($addressBooks)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $addressBook = Auth::user()->addressBooks()->findOrFail($id);
        return view('contact.create', [
            'addressBook' => new AddressBookResource($addressBook)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStoreRequest $request)
    {
        $input = $request->validated();
        $addressBook = Auth::user()->addressBooks()->findOrFail($input['addressbook_id']);
        foreach ($input['emails'] as $email) {
            $contact = new Contact();
            $contact->address = $email;
            $contact->is_email = true;
            $contact->addressBook()->associate($addressBook);
            $contact->save();
        }
        foreach ($input['numbers'] as $number) {
            $contact = new Contact;
            $contact->address = $number;
            $contact->is_email = false;
            $contact->addressBook()->associate($addressBook);
            $contact->save();
        }
        return response()->json([
            'addressBook' => $addressBook
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($addressBookId)
    {
        $addressBook = Auth::user()->addressBooks()->with(['contacts'])->findOrFail($addressBookId);
        return view('contact.show', [
            'addressBook' => new AddressBookResource($addressBook)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactDestroyRequest $request)
    {
        $input = $request->validated();
        $addressBook = Auth::user()->addressBooks()->findOrFail($input['addressbook_id']);
        $contact = $addressBook->contacts()->findOrFail($input['contact_id']);
        $contact->delete();
        $addressBook->load('contacts');
        return response()->json(['addressbook' => new AddressBookResource($addressBook)], 202);
    }
}
