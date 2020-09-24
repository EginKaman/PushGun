<?php

namespace App\Http\Controllers;

use App\Message;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $message = new Message();
        $message->fill($request->all());
        $message->user()->associate(Auth::user());
        $message->ticket()->associate($ticket);
        $message->save();
        return redirect()->route('ticket.show', $ticket);
    }
}
