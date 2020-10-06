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

    @stack('scripts')

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
                            <span>@lang('Главная')</span>
                            <img class="nav__item_img" src="{{ asset('images/main.svg') }}" alt="">
                        </div>
                    </a>

                    <a href="{{ route('push.index') }}" class="nav__item">
                        <div class="nav__item_wrap">
                            <span>@lang('Мои рассылки')</span>
                            <img class="nav__item_img" src="{{ asset('images/send.svg') }}" alt="">
                        </div>
                    </a>

                    <div class="nav__wrapper">
                        <a href="#" class="nav__item nav__arrow">
                            <div class="nav__item_wrap">
                                <span>@lang('Мои сайты')</span>
                                <img class="nav__item_img" src="{{ asset('images/sites.svg') }}" alt="">
                            </div>
                        </a>
                        <header-sites-component></header-sites-component>
                    </div>

                    <a href="{{ route('tariff.index') }}" class="nav__item">
                        <div class="nav__item_wrap">
                            <span>@lang('Тарифы')</span>
                            <img class="nav__item_img" src="{{ asset('images/tarif.svg') }}" alt="">
                        </div>
                    </a>

                </nav>
                <div class="header__subscription">
                    <h3 class="header__subscription_title">@lang(Auth::user()->tariff->name)</h3>
                    <a href="{{ route('tariff.index') }}" class="header__subscription_link">@lang('Повысить тариф')</a>
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
                        <h3 class="account__bottom_subscribtion">@lang('Тариф') "@lang(Auth::user()->tariff->name)"</h3>
                        <a href="{{ route('tariff.index') }}"
                           class="account__bottom_subscribe">@lang('Повысить тариф')</a>
{{--                        <div class="account__bottom_balance-wrapper">--}}
{{--                            <p class="account__bottom_balance">@lang('Баланс')--}}
{{--                                <span>{{ Auth::user()->balance }} @lang('руб')</span></p>--}}
{{--                            <a href="{{ route('tariff.index') }}" class="account__bottom_subscribe">@lang('Пополнить')</a>--}}
{{--                        </div>--}}
                        <div class="account__bottom_links">
                            <div class="account__link_wrapper icon icon-pay">
                                <a href="#" class="account__bottom_link">@lang('Платежи')</a>
                            </div>
                            <div class="account__link_wrapper icon icon-settings">
                                <a href="{{ route('account.edit') }}" class="account__bottom_link">
                                    @lang('Настройки аккаунта')
                                </a>
                            </div>
                            <div class="account__link_wrapper lang--toggle icon icon-language">
                                <span>@lang('Сменить язык')</span>
                                <ul>
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li>
                                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"><img
                                                    src="{{ asset('images/' . $localeCode . '.svg') }}"
                                                    alt="{{ $localeCode }}"> {{ $properties['native'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="account__link_wrapper icon icon-support">
                                <a href="{{ route('ticket.index') }}" class="account__bottom_link">
                                    @lang('Тех. поддержка')
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="account__link_exit">
                        <div class="account__link_wrapper icon icon-exit">
                            <a href="{{ route('logout') }}" class="account__bottom_link"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                @lang('Выйти')
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header__popup">
                <div class="header__popup_inner">
                    <div class="nav__item_wrap">
                        <a href="{{ route('account.index') }}">@lang('Главная')</a>
                        <img class="nav__item_img" src="{{ asset('images/main.svg') }}" alt="">
                    </div>
                    <div class="nav__item_wrap">
                        <a href="{{ route('push.index') }}">@lang('Мои рассылки')</a>
                        <img class="nav__item_img" src="{{ asset('images/send.svg') }}" alt="">
                    </div>
                    <div class="nav__item_wrap">
                        <a href="#">@lang('Мои сайты')</a>
                        <img class="nav__item_img" src="{{ asset('images/sites.svg') }}" alt="">
                    </div>
                    <div class="nav__item_wrap">
                        <a href="{{ route('tariff.index') }}">@lang('Тарифы')</a>
                        <img class="nav__item_img" src="{{ asset('images/tarif.svg') }}" alt="">
                    </div>
                    <div class="header__subscription header__mobile_sub">
                        <h3 class="header__subscription_title">@lang('Тариф') "@lang(Auth::user()->tariff->name)"</h3>
                        <a href="{{ route('tariff.index') }}"
                           class="header__subscription_link">@lang('Повысить тариф')</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <div class="tooltip_templates">
            <span id="tooltip_content" class="general__tooltip">
                <p>@lang('Информация')</p>
                <a href="#">@lang('Как переподписать пользователей на SendPulse')</a>
                <a href="#">@lang('Как переподписать пользователей на SendPulse')</a>
            </span>
    </div>
    <footer class="footer">
        <a href="">@lang('База знаний')</a>
        <a href="{{ route('ticket.index') }}">@lang('Тех. поддержка')</a>
        <a href="{{ route('page.privacy') }}">@lang('Политика конфиденциальности')</a>
    </footer>
</div>
</body>
</html>
