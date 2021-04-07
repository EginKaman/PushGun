@extends('layouts.app')
@section('title', __('Мои рассылки'))
@section('content')
    <main class="main mymailing mailpush">
        <div class="container">
            <section class="mails">
                <div class="filter__popup">
                    <form action="{{ route('push.index') }}">
                        <div class="filter__popup__inner">
                            <div class="filter__popup_block w-50">
                                <label class="filter__popup_label" for="firstDate-input">@lang('Начальная дата')</label>
                                <input id="firstDate-input" class="datepicker-here filter__input" name="start" type="text"
                                    value="{{ request('start') }}">
                            </div>
                            <div class="filter__popup_block w-50">
                                <label class="filter__popup_label" for="lastDate-input">@lang('Конечная дата')</label>
                                <input id="lastDate-input" class="datepicker-here filter__input" name="end" type="text"
                                    value="{{ request('end') }}">
                            </div>
                            <div class="filter__popup_block">
                                <label class="filter__popup_label" for="text-input">@lang('Текст')</label>
                                <input id="text-input" class="filter__input" name="text" type="text"
                                    value="{{ request('text') }}">
                            </div>
                            <div class="filter__popup_block">
                                <label class="filter__popup_label" for="site">@lang('Сайт')</label>
                                <select id="site" class="filter__input filter__selector" name="site" type="text">
                                    <option v-for="site in $store.state.sites.sites" :key="site.id" @if (request('site')) :selected="site.id === {{ request('site') }}" @endif :value="site.id">@{{ site . link }}
                                    </option>
                                </select>
                            </div>
                            <div class="button_lb">
                                <span class="lb_button_circle">
                                </span>
                                <a href="{{ route('push.index') }}" class="button_lb_inner">
                                    <p class="lb_button_text_container">
                                        @lang('Сброс')
                                    </p>
                                </a>
                            </div>
                            <div id="btn_select" class="button_rb">
                                <span class="rb_button_circle">
                                </span>
                                <button class="button_rb_inner" type="submit">
                                    <p class="rb_button_text_container">
                                        @lang('Выбрать')
                                    </p>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="general__title">
                    <h1 class="title">@lang('Мои рассылки')</h1>
                </div>
                <div style="margin-bottom: 15px;" class="create-mail">
                    <div class="button_green mr-24">
                        <span class="green_button_circle desplode-circle" style="left: 51px; top: 43.125px;">
                        </span>
                        <a href="{{ route('email.create') }}" class="button_green_inner">
                            <img src="{{ asset('images/plusik.svg') }}" alt="">
                            <p class="button_text_container"><img src="" alt="">Создать e-mail компанию</p>
                        </a>
                    </div>
                    <div class="button_green mr-24">
                        <span class="green_button_circle desplode-circle" style="left: 51px; top: 43.125px;">
                        </span>
                        <a href="{{ route('email.sms') }}" class="button_green_inner">
                            <img src="{{ asset('images/plusik.svg') }}" alt="">
                            <p class="button_text_container"><img src="" alt="">Создать SMS рассылку</p>
                        </a>
                    </div>
                </div>
                <div class="email-push__stat">
                    <div class="email-push__stat__item">
                        <span>
                            {{ $sentLettersCount }}
                        </span>
                        <p>отправлено</p>
                    </div>
                    <div class="email-push__stat__item">
                        <span>
                            {{ $sentLettersCount }}
                        </span>
                        <p>доставлено</p>
                    </div>
                    <div class="email-push__stat__item">
                        <span>156</span>
                        <p>открытий</p>
                    </div>
                    <div class="email-push__stat__item">
                        <span>35</span>
                        <p>переходов</p>
                    </div>
                    <div class="email-push__stat__item">
                        <span>2</span>
                        <p>отписалось</p>
                    </div>
                    <div class="email-push__stat__item">
                        <span>10</span>
                        <p>ошибки</p>
                    </div>
                </div>
                <email-push-component :emailMailings="{{ json_encode($emailMailings) }}"></email-push-component>
            </section>
        </div>
    </main>
@endsection
