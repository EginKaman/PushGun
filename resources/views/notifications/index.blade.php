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
                        <a class="active"><p>{{ $message->title }}</p>
                            @if($message->created_at->diffInDays(now()) < 1)
                                <span>новое</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
