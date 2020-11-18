@extends('layouts.app')
@section('title', __('Уведомления'))
@push('scripts')
@endpush
@section('content')
<main class="main single-mail">
    <section class="notifications-page">
        <div class="container">
            <h2>Уведомления</h2>
            <div class="notifications-list">
                @foreach($system_messages as $message)
                <div class="notif-list__item">
                    <p style="margin-top: 15px; font-size: 13px;">{{ $message->created_at->format('d.m.Y') }}</p>
                    <a class="active">
                        <p>{{ $message->title }}</p>
                        @if($message->created_at->diffInDays(now()) < 1) <span>новое</span>
                            @endif
                    </a>
                    <p style="text-decoration: none; margin-top: 15px;">{!! \Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($message->text) !!}</p>

                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection