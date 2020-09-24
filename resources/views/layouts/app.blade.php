<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <a href="{{ route('account.index') }}" class="header__logo">
                    <img src="{{ asset('images/logo.svg') }}" alt="" class="header__logo_img">
                </a>
                <nav class="nav">
                    <a href="{{ route('account.index') }}" class="nav__item">
                        <div class="nav__item_wrap">
                            <span>Главная</span>
                            <img class="nav__item_img" src="{{ asset('images/main.svg') }}" alt="">
                        </div>
                    </a>

                    <a href="{{ route('push.index') }}" class="nav__item">
                        <div class="nav__item_wrap">
                            <span>Мои рассылки</span>
                            <img class="nav__item_img" src="{{ asset('images/send.svg') }}" alt="">
                        </div>
                    </a>

                    <div class="nav__wrapper">
                        <a href="#" class="nav__item nav__arrow">
                            <div class="nav__item_wrap">
                                <span>Мои сайты</span>
                                <img class="nav__item_img" src="{{ asset('images/sites.svg') }}" alt="">
                            </div>
                        </a>
                        <header-sites-component></header-sites-component>
                    </div>

                    <a href="{{ route('tariff.index') }}" class="nav__item">
                        <div class="nav__item_wrap">
                            <span>Тарифы</span>
                            <img class="nav__item_img" src="{{ asset('images/tarif.svg') }}" alt="">
                        </div>
                    </a>

                </nav>
                <div class="header__subscription">
                    <h3 class="header__subscription_title">{{ Auth::user()->tariff->name }}</h3>
                    <a href="{{ route('tariff.index') }}" class="header__subscription_link">Повысить тариф</a>
                </div>
                <div class="header__menu_wrap">
                    <a class="header__account">
                        @empty(Auth::user()->photo)
                            <img class="header__account_img" src="{{ asset('images/avatar.svg') }}" alt="">
                        @else
                            <img class="header__account_img" src="{{ asset(Storage::url(Auth::user()->photo)) }}"
                                 alt="">
                        @endempty
                    </a>
                    <div class="header__burger">
                        <img src="{{ asset('images/menu.svg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="account__popup">
                <div class="account__inner">
                    <div class="account__top">
                        <p class="account__top_name">{{ Auth::user()->name }}</p>
                        <p class="account__top_email">{{ Auth::user()->email }}</p>
                        <p class="account__top_id">ID <span>{{ Auth::id() }}</span></p>
                    </div>
                    <div class="account__bottom">
                        <h3 class="account__bottom_subscribtion">Тариф "{{ Auth::user()->tariff->name }}"</h3>
                        <a href="{{ route('tariff.index') }}" class="account__bottom_subscribe">Повысить тариф</a>
                        <div class="account__bottom_balance-wrapper">
                            <p class="account__bottom_balance">Баланс <span>{{ Auth::user()->balance }} руб</span></p>
                            <a href="payment.html" class="account__bottom_subscribe">Пополнить</a>
                        </div>
                        <div class="account__bottom_links">
                            <div class="account__link_wrapper icon icon-pay">
                                <a href="#" class="account__bottom_link">Платежи</a>
                            </div>
                            <div class="account__link_wrapper icon icon-settings">
                                <a href="{{ route('account.edit') }}" class="account__bottom_link">
                                    Настройки аккаунта
                                </a>
                            </div>
                            <div class="account__link_wrapper icon icon-support">
                                <a href="{{ route('ticket.index') }}" class="account__bottom_link">
                                    Тех. поддержка
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="account__link_exit">
                        <div class="account__link_wrapper icon icon-exit">
                            <a href="#" class="account__bottom_link">Выйти</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header__popup">
                <div class="header__popup_inner">
                    <div class="nav__item_wrap">
                        <a href="{{ route('account.index') }}">Главная</a>
                        <img class="nav__item_img" src="{{ asset('images/main.svg') }}" alt="">
                    </div>
                    <div class="nav__item_wrap">
                        <a href="{{ route('push.index') }}">Мои рассылки</a>
                        <img class="nav__item_img" src="{{ asset('images/send.svg') }}" alt="">
                    </div>
                    <div class="nav__item_wrap">
                        <a href="#">Мои сайты</a>
                        <img class="nav__item_img" src="{{ asset('images/sites.svg') }}" alt="">
                    </div>
                    <div class="nav__item_wrap">
                        <a href="{{ route('tariff.index') }}">Тарифы</a>
                        <img class="nav__item_img" src="{{ asset('images/tarif.svg') }}" alt="">
                    </div>
                    <div class="header__subscription header__mobile_sub">
                        <h3 class="header__subscription_title">Подписка 1000</h3>
                        <a href="{{ route('tariff.index') }}" class="header__subscription_link">Повысить тариф</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <div class="tooltip_templates">
            <span id="tooltip_content" class="general__tooltip">
                <p>Информация</p>
                <a href="#">Как переподписать пользователей на SendPulse</a>
                <a href="#">Как переподписать пользователей на SendPulse</a>
            </span>
    </div>
    <footer class="footer">
        <a href="">База знаний</a>
        <a href="{{ route('ticket.index') }}">Тех. поддержка</a>
        <a href="{{ route('page.privacy') }}">Политика конфиденциальности</a>
    </footer>
</div>
</body>
</html>
