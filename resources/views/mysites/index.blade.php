@extends('layouts.app')
@section('title', __('Мои сайты'))
@section('content')

<main class="main">
    <div class="container">
        <section class="general">
            <div class="general__title">
                <h1 class="title">@lang('Мои сайты')</h1>
            </div>
            <my-sites-component></my-sites-component>
            <div class="button_green mr-24">
                <span class="green_button_circle"></span>
                <a href="{{ route('site.create') }}" class="button_green_inner">
                    <p class="button_text_container">
                        <img src="{{ asset('images/send.svg') }}" alt="">@lang('Добавить сайт')
                    </p>
                </a>
            </div>
        </section>
    </div>
</main>
@endsection