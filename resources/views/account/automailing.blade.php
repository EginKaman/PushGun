@extends('layouts.app')
@section('title', __('Авторассылки'))
@section('content')
    <main class="main automailing">
        <div class="container">
            <div class="general__title">
                <div class="title">
                    Авторассылки для push-сообщений
                </div>
                <p class="sub-title">
                    Авторассылки — это автоматически настроенная рассылка сообщений согласно заданным вами условиям.
                    Настройте один раз отправку автосообщений и ваши подписчики будут получать их в автоматическом
                    режиме.
                </p>
            </div>
            <auto-mailing-component></auto-mailing-component>
        </div>
    </main>
@endsection