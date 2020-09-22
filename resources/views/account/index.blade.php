@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="container">
            <section class="general">
                <div class="general__title">
                    <h1 class="title">Web Push рассылки</h1>
                    <img class="general__info tooltip" data-tooltip-content="#tooltip_content"
                         src="{{ asset('images/info.svg') }}"
                         alt="">
                </div>
                <div class="general__status">
                    <div class="general__subs">
                        <p class="">Подписчиков: <span>500</span> из 1000</p>
                        <p class="percent">50%</p>
                    </div>
                    <div class="progress">
                        <progress max="100" value="50"></progress>
                        <div class="progress_bg">
                            <div class="progress_bar"></div>
                        </div>
                    </div>
                    <div class="general__status_info">
                        <p>Тариф “Бесплатно 10 000” будет продлен 16 июня 2020 г.</p>
                        <a href="#" class="account__bottom_subscribe">Изменить</a>
                    </div>
                </div>
                <div class="general__stats">
                    <div class="general__stats_left">
                        <div class="general__stats_left-item stats__item" style="background: #FF808B;">
                            <h3>2</h3>
                            <div class="mb-10">
                                <p class="medium">активных подписчиков</p>
                                <p class="semibold">за сегодня: 0</p>
                            </div>
                        </div>
                        <div class="general__stats_left-item" style="background: #9698D5;">
                            <h3>2</h3>
                            <p class="medium mb-10">100% доставлено</p>
                        </div>
                        <div class=" general__stats_left-item" style="background: #4AB731;">
                            <h3>2</h3>
                            <div class="mb-10">
                                <p class="medium">50% переходов</p>
                                <p class="semibold">за сегодня: 0</p>
                            </div>
                        </div>
                        <div class="general__stats_left-item" style="background: #36C2CF;">
                            <h3>2</h3>
                            <p class="medium mb-10">рассылок</p>
                        </div>
                    </div>
                    <div class=" general__stats_right">
                        <div class="general__stats_right__inner">
                            <div class="general__stats_right-top">
                                <h3>Статистика последних рассылок</h3>
                                <div class="general__stats_right-buttons">
                                    <div class="general__stats_right-double_button">
                                        <button id="days" class="button button_left-btn selected">По
                                            дням
                                        </button>
                                        <button id="weeks" class="button button_right-btn">По неделям</button>
                                    </div>
                                    <select id="selector" class="stats__selector">
                                        <option value="1">За месяц</option>
                                        <option value="2">За год</option>
                                    </select>
                                </div>
                            </div>
                            <div class="canvas-container">
                                <canvas id="myChart"></canvas>
                            </div>
                            <div class="current__stats">
                                <div class="current__stats_item">
                                    <h3 style="color: #36C2CF;">3</h3>
                                    <p class="current__stats_desc">рассылок</p>
                                </div>
                                <div class="current__stats_item">
                                    <h3 style="color: #5BA4D7;">3</h3>
                                    <p class="current__stats_desc">отправлено</p>
                                </div>
                                <div class="current__stats_item">
                                    <h3 style="color: #9698D5;">3</h3>
                                    <p class="current__stats_desc">15% доставлено</p>
                                </div>
                                <div class="current__stats_item">
                                    <h3 style="color: #68B781;">3</h3>
                                    <p class="current__stats_desc">10% переходов</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="subtitle">Мои сайты</h2>
                <div class="general__sites">
                    @foreach($sites as $site)
                        <div class="general__sites_item">
                            <div class="general__sites_item-more">
                                <img src="{{ asset('images/more.svg') }}" alt="">
                            </div>
                            <a href="{{ route('site.show', ['site' => $site]) }}">
                                {{--<img class="general__sites_item-img" src="{{ asset('images/site.svg') }}" alt="">--}}
                                <img class="general__sites_item-img" src="{{ asset( Storage::url($site->image) ) }}"
                                     alt="">
                            </a>
                            <div class="general__sites_info @if($site->installed)checkmark @endif">
                                <a href="{{ route('site.show', $site) }}"
                                   class="account__bottom_subscribe general__sites_title">{{ $site->link }}</a>
                                <p>Подписчиков: <span>{{ $site->push_subscriptions_count }}</span></p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="button_green mr-24">
                            <span class="green_button_circle">
                            </span>
                    <a href="{{ route('push.create') }}" class="button_green_inner">
                        <p class="button_text_container">
                            <img src="{{ asset('images/send.svg') }}" alt="">Отправить PUSH
                        </p>
                    </a>
                </div>
                <div class="button_white">
                    <span class="white_button_circle"></span>
                    <a href="{{ route('site.create') }}" class="button_white_inner">
                        <p class="button_text_container">
                            <img class="button-img" src="{{ asset('images/add.svg') }}" alt="">Добавить новый сайт
                        </p>
                    </a>
                </div>
            </section>
        </div>
    </main>
@endsection
