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
                    <p>Статистика</p>
                </div>

                <div class="general__stats_left">
                    <div class="general__stats_left-item" style="background: #3B8378;">
                        <h3>{{ $site->push_subscriptions_count }}</h3>
                        <div class="mb-10">
                            <p class="medium">активных подписчиков</p>
                        </div>
                    </div>
                    <div class="general__stats_left-item" style="background: #5BA4D7;">
                        <h3>2</h3>
                        <p class="medium mb-10">100% доставлено</p>
                    </div>
                    <div class=" general__stats_left-item" style="background: #FF7226;">
                        <h3>2</h3>
                        <div class="mb-10">
                            <p class="medium">50% переходов</p>
                        </div>
                    </div>
                    <div class="general__stats_left-item" style="background: #36C2CF;">
                        <h3>{{ $site->pushes_count }}</h3>
                        <p class="medium mb-10">рассылок</p>
                    </div>
                </div>
                <div class="general__stats_right site__chart">
                    <div class="general__stats_right__inner">
                        <div class="general__stats_right-top">
                            <select id="selector" class="stats__selector">
                                <option value="1">Новых подписчиков</option>
                                <option value="2">Доставлено</option>
                            </select>
                            <div class="general__stats_right-buttons">
                                <div class="general__stats_right-double_button">
                                    <button id="days-subs" class="button button_left-btn selected">По
                                        дням
                                    </button>
                                    <button id="weeks-subs" class="button button_right-btn">По неделям</button>
                                </div>
                            </div>
                        </div>
                        <div class="canvas-container2">
                            <canvas id="myChart2"></canvas>
                        </div>
                        <div class="site__chart_desc">
                            <p>Новых подписчиков за период: <span>1</span></p>
                            <p>Отписанных: <span>1</span></p>
                        </div>
                    </div>
                </div>
                <div class="button_green mr-24">
                    <span class="green_button_circle"></span>
                    <a href="{{ route('push.create') }}" class="button_green_inner">
                        <p class="button_text_container">
                            <img src="{{ asset('images/send.svg') }}" alt="">Отправить PUSH
                        </p>
                    </a>
                </div>
                <div class="button_white">
                    <span class="white_button_circle"></span>
                    <a href="settings.html" class="button_white_inner">
                        <p class="button_text_container">
                            <img class="button-img" src="{{ asset('images/settingsDark.svg') }}" alt="">Настройки сайта
                        </p>
                    </a>
                </div>
            </section>
        </div>
    </main>
@endsection
