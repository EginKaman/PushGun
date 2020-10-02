@extends('layouts.app')
@section('title', __('Статистика сайта'))
@section('content')
    <main class="main">
        <div class="container">
            <section class="mail site">
                <div class="general__title">
                    <h1 class="title">{{ $site->link }}</h1>
                    <img src="{{ asset('images/mark.svg') }}" alt="">
                </div>
                <div class="mail__time-sent">
                    <p>@lang('Статистика')</p>
                </div>

                <div class="general__stats_left">
                    <div class="general__stats_left-item" style="background: #3B8378;">
                        <h3>{{ $site->push_subscriptions_count }}</h3>
                        <div class="mb-10">
                            <p class="medium">@lang('активных подписчиков')</p>
                        </div>
                    </div>
                    <div class="general__stats_left-item" style="background: #5BA4D7;">
                        <h3>2</h3>
                        <p class="medium mb-10">100% @lang('доставлено')</p>
                    </div>
                    <div class=" general__stats_left-item" style="background: #FF7226;">
                        <h3>2</h3>
                        <div class="mb-10">
                            <p class="medium">50% @lang('переходов')</p>
                        </div>
                    </div>
                    <div class="general__stats_left-item" style="background: #36C2CF;">
                        <h3>{{ $site->pushes_count }}</h3>
                        <p class="medium mb-10">@lang('рассылок')</p>
                    </div>
                </div>
                <div class="general__stats_right site__chart">
                    <div class="general__stats_right__inner">
                        <div class="general__stats_right-top">
                            <select id="selector" class="stats__selector">
                                <option value="1">@lang('Новых подписчиков')</option>
                                <option value="2">@lang('Доставлено')</option>
                            </select>
                         <!--    <div class="general__stats_right-buttons">
                                <div class="general__stats_right-double_button">
                                    <button id="days-subs" class="button button_left-btn selected">
                                        @lang('По дням')
                                    </button>
                                    <button id="weeks-subs" class="button button_right-btn">
                                        @lang('По неделям')
                                    </button>
                                </div>
                            </div> -->
                            <chart-nav-component name-service='FETCH_INDIVIDUAL_STATISTICS' />
                        </div>
                        <div class="canvas-container2">
                            <statistic-individual-chart-component address="{{ $site->id }}"/>
                        </div>
                        <div class="site__chart_desc">
                            <p>@lang('Новых подписчиков за период'): <span>1</span></p>
                            <p>@lang('Отписанных'): <span>1</span></p>
                        </div>
                    </div>
                </div>
                <div class="button_green mr-24">
                    <span class="green_button_circle"></span>
                    <a href="{{ route('push.create') }}" class="button_green_inner">
                        <p class="button_text_container">
                            <img src="{{ asset('images/send.svg') }}" alt="">@lang('Отправить PUSH')
                        </p>
                    </a>
                </div>
                <div class="button_white">
                    <span class="white_button_circle"></span>
                    <a href="{{ route('site.edit', $site) }}" class="button_white_inner">
                        <p class="button_text_container">
                            <img class="button-img" src="{{ asset('images/settingsDark.svg') }}"
                                 alt="">@lang('Настройки сайта')
                        </p>
                    </a>
                </div>
            </section>
        </div>
    </main>
@endsection
