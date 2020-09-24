@extends('layouts.app')
@section('title', __('Тикет №') . $ticket->id)
@section('content')
    <div class="container">
        <section class="ticket">
            <div class="general__title"><h1 class="title">@lang('Просмотр тикета')</h1></div>
            <div class="mail__time-sent">
                <strong>@lang('Тема'):</strong>
                <p>{{ $ticket->message }}</p>
            </div>
            @foreach($ticket->messages as $message)
                <div class="ticket-wrap">
                    <div class="ticket-avatar">
                        @empty($message->user->photo)
                            <figure><img src="{{ asset('images/user1.png') }}" alt=""></figure>
                        @else
                            <figure><img src="{{ asset(Storage::url($message->user->photo)) }}" alt=""></figure>
                        @endempty
                    </div>
                    <div class="ticket-chat">
                        <div class="ticket-chat__top">
                            <h3 class="ticket-name">
                                {{ $message->user->name }} {{ $message->user->lastname }}<small>@lang('пишет')</small>
                            </h3>
                            <span class="ticket-data">{{ $message->created_at }}</spa   n></div>
                        <div class="ticket-chat__text">
                            <p>{{ $message->text }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="ticket-wrap">

                <div class="ticket-avatar">
                    @empty($message->user->photo)
                        <figure><img src="{{ asset('images/user1.png') }}" alt=""></figure>
                    @else
                        <figure><img src="{{ asset(Storage::url($message->user->photo)) }}" alt=""></figure>
                    @endempty
                </div>
                <form action="{{ route('message.store', $ticket) }}" method="POST" class="ticket-answer">
                    @csrf
                    <textarea name="text" id="" cols="30" rows="10"></textarea>
                    <label for="ticketFile" class="ticket-file">
                        <span class="ticket-fileName"></span>
                        <img src="{{ asset('images/file.svg') }}" class="file-img" alt="">
                        <img src="{{ asset('images/remove.svg') }}" class="file-img-remove" alt="">
                        <input type="file" name="file" id="ticketFile">
                    </label>
                    <div class="setgen__down-buttons ticket-btn">
                        <div class="button_green save__button">
                            <span class="green_button_circle">
                            </span>
                            <button type="submit" class="button_green_inner">
                                <p class="button_text_container">
                                    @lang('Отправить')
                                </p>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
