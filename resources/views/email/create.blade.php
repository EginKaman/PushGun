@extends('layouts.app')
@section('title', __('Новая e-mail рассылка'))
@section('content')
<main class="main email-push-show">
    <div class="container">
        <section class="mails">
            <div style="margin-top: 20px;" class="general__title">
                <h1 class="title">@lang('')</h1>
            </div>
            <create-email-push-component :addressBooks="{{json_encode($addressBooks)}}"></create-email-push-component>
        </section>
    </div>
</main>
@endsection