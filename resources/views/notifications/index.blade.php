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
                <a class="active"><p>Ежемесячная подписка - 30 000 подписчиков</p><span>новое</span></a>
                <a class="active"><p>Статистика последних рассылок</p><span>новое</span></a>
                <a><p>Ежемесячная подписка - 30 000 подписчиков</p><span>новое</span></a>
            </div>
        </div>
    </section>
</main>
@endsection