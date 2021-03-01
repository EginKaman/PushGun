@extends('layouts.app')
@section('title', __('Название рассылки'))
@section('content')
<main class="main email-push-show">
    <div class="container">
        <section class="mails">
            <div class="general__title">
                <h1 class="title">@lang('Название рассылки')</h1>
            </div>
            <email-push-show-component></email-push-show-component>
        </section>
    </div>
</main>
@endsection