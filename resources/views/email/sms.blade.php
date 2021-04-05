@extends('layouts.app')
@section('title', __('Отправить sms'))
@section('content')
<main class="main email-push-show sms-create">
    <div class="container setting-mailing">
        <section class="mails">
            <div class="general__title">
                <h1 class="title">@lang('Отправить sms')</h1>
            </div>
            <sms-create-component></sms-create-component>
        </section>
    </div>
</main>
@endsection