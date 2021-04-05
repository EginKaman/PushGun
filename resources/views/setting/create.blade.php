@extends('layouts.app')
@section('title', __('Регистрация имени отправителя'))
@section('content')
<main class="main email-push-show send-name">
    <div class="container setting-mailing">
        <section class="mails">
            <div class="general__title">
                <h1 class="title">@lang('Регистрация имени отправителя')</h1>
            </div>
            
            <register-send-name-component></register-send-name-component>
        </section>
    </div>
</main>
@endsection