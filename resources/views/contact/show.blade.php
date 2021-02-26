@extends('layouts.app')
@section('title',__('Адресная книга'))
@section('content')
<div class="main contact">
    <div class="container">
        <div style="margin-bottom: 0;" class="general__title">
            <h1 class="title">@lang('Адресная книга')</h1>
        </div>
        <div class="general__pretitle">
            <p>Активная<span>03.02.2021, 15:00</span></p>
        </div>
        <div class="email-btn">
            <div class="button_green mr-24">
                <span class="green_button_circle"></span>
                <a href="{{ route('contact.create') }}" class="button_green_inner">
                    <p class="button_text_container">
                        <img src="{{ asset('images/book.svg') }}" alt="">@lang('Новая адресная книга')
                    </p>
                </a>
            </div>
            <div class="button_white">
                <span class="white_button_circle"></span>
                <a href="{{ route('site.create') }}" class="button_white_inner">
                    <p class="button_text_container">
                        <img class="button-img" src="{{ asset('images/plusik.svg') }}" alt="">@lang('Создать рассылку')
                    </p>
                </a>
            </div>
        </div>
        <show-contact-component></show-contact-component>
    </div>
</div>
@endsection