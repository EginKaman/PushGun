<?php

namespace App\Http\Controllers;

use App\AddressBook;
use App\EmailMailing;
use App\EmailMessage;
use App\Http\Requests\EmailMailingCreateRequest;
use App\Http\Resources\AddressBooksResource;
use App\Http\Resources\EmailMailingResource;
use App\Http\Resources\EmailMailingsResource;
use App\Http\Resources\EmailSendersResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use NotificationChannels\WebPush\PushSubscription;

class EmailPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user->loadCount(['pushes']);
        $sites = $user->sites;
        // $sites->loadCount('pushSubscriptions', 'todaySubscriptions', 'transitions', 'todayTransitions');
        $sites->loadCount('pushSubscriptions', 'todaySubscriptions');
        return view('email.index', [
            'user' => $user,
            'sites' => $sites,
            'pushes' => $user->pushes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function push()
    {
        $user = Auth::user();
        $emailMailings = $user->emailMailings()->with(['addressBook'])->get();
        $sentLettersCount = 0;
        foreach ($emailMailings as $emailMailing) {
            $sentLettersCount += $emailMailing->number_of_sent;
        }
        return view('email.push', [
            'emailMailings' => new EmailMailingsResource($emailMailings),
            'sentLettersCount' => $sentLettersCount
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $addressBooks = $user->addressBooks()->get();
        $emailSenders = $user->emailSenders()->get();
        return view('email.create', [
            'addressBooks' => new AddressBooksResource($addressBooks),
            'emailSenders' => new EmailSendersResource($emailSenders)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailMailingCreateRequest $request)
    {
        $user = Auth::user();
        $input = $request->validated();
        $actualEmailTariff = $user->getActualEmailTariff();
        $addressbook = AddressBook::find($input['address_book_id']);
        $contactCount = $addressbook->contacts()->count();
        if ($contactCount > $actualEmailTariff->max_contacts) {
            return response()->json([
                'message' => "Ваш тариф не позволяет создать рассылку"
            ]);
        }
        $emailMailing = new EmailMailing;
        $emailMessage = new EmailMessage;
        $emailMailing->user()->associate($user);
        $emailMessage->user()->associate($user);
        $emailMessage->preheader = $input['preheader'];
        // $emailMessage->image = $input['image']->store('public/mails');
        $emailMessage->body = $input['body'];
        $emailMessage->save();
        $emailMailing->fill($input);
        $emailMailing->addressBook()->associate($addressbook);
        $emailMailing->emailMessage()->associate($emailMessage);
        $emailMailing->emailSender()->associate($input['email_sender_id']);
        $emailMailing->save();
        return response()->json([
            'id' => $emailMailing->id
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emailMailing = Auth::user()->emailMailings()->with(['addressBook', 'addressBook.contacts', 'emailMessage'])->findOrFail($id);
        return view('email.show', [
            'emailMailing' => new EmailMailingResource($emailMailing)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
