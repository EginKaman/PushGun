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
            <!-- Флекс блок + обертки для кнопок, теперь они flex -->
            <div class="autoMailingFlex" style="display:flex;">
                <div class="btnWrapperFlex">
                    <auto-mailing-component></auto-mailing-component>
                </div>

                <div class="btnWrapperFlex2">
                    <div class="button_white">
                        <span class="white_button_circle"></span>
                            <a :href="route('account.createmailingrss')" class="button_white_inner">
                                <p class="button_text_container">
                                <img class="button-img" src="{{ asset('images/plusik.svg') }}" alt="">Создать RSS
                                 рассылку
                                </p>
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection