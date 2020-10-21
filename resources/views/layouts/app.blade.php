<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Фавиконы и иконки сайта -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}"
          data-mce-href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/favicon-32x32.png') }}" sizes="32x32"
          data-mce-href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/favicon-16x16.png') }}" sizes="16x16"
          data-mce-href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/android-chrome-192x192.png') }}" sizes="192x192"
          data-mce-href="{{ asset('images/favicon/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/android-chrome-512x512.png') }}" sizes="512x512"
          data-mce-href="{{ asset('images/favicon/android-chrome-512x512.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#4285f4">

    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#4285f4">

    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- Яндекс.Браузер -->
    <meta name="viewport" content="ya-title=#4e69a2,ya-dock=fade">

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
                    @auth
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
                    @endauth
                    <a href="{{ route('tariff.index') }}" class="nav__item">
                        <div class="nav__item_wrap">
                            <span>@lang('Тарифы')</span>
                            <img class="nav__item_img" src="{{ asset('images/tarif.svg') }}" alt="">
                        </div>
                    </a>

                </nav>
                @auth
                    <div class="header__subscription">
                        <h3 class="header__subscription_title">@lang(Auth::user()->tariff->name)</h3>
                        <a href="{{ route('tariff.index') }}"
                           class="header__subscription_link">@lang('Повысить тариф')</a>
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
                @endauth
            </div>
            @auth
                <div class="account__popup">
                    <div class="account__inner">
                        <div class="account__top">
                            <p class="account__top_name">{{ Auth::user()->name }}</p>
                            <p class="account__top_email">{{ Auth::user()->email }}</p>
                            <p class="account__top_id">ID <span>{{ Auth::id() }}</span></p>
                        </div>
                        <div class="account__bottom">
                            <h3 class="account__bottom_subscribtion">
                                @lang('Тариф') "@lang(Auth::user()->tariff->name)"
                            </h3>
                            <a href="{{ route('tariff.index') }}"
                               class="account__bottom_subscribe">@lang('Повысить тариф')</a>
                            {{--                        <div class="account__bottom_balance-wrapper">--}}
                            {{--                            <p class="account__bottom_balance">@lang('Баланс')--}}
                            {{--                                <span>{{ Auth::user()->balance }} @lang('руб')</span></p>--}}
                            {{--                            <a href="{{ route('tariff.index') }}" class="account__bottom_subscribe">@lang('Пополнить')</a>--}}
                            {{--                        </div>--}}
                            <div class="account__bottom_links">
                                <div class="account__link_wrapper icon icon-pay">
                                    <a href="{{ route('payment.index') }}"
                                       class="account__bottom_link">@lang('Платежи')</a>
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
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endauth

            <div class="header__popup">
                <div class="header__popup_inner">
                    <div class="nav__item_wrap">
                        <a href="{{ route('account.index') }}">@lang('Главная')</a>
                        <img class="nav__item_img" src="{{ asset('images/main.svg') }}" alt="">
                    </div>
                    @auth
                        <div class="nav__item_wrap">
                            <a href="{{ route('push.index') }}">@lang('Мои рассылки')</a>
                            <img class="nav__item_img" src="{{ asset('images/send.svg') }}" alt="">
                        </div>
                        <div class="nav__item_wrap">
                            <a href="#">@lang('Мои сайты')</a>
                            <img class="nav__item_img" src="{{ asset('images/sites.svg') }}" alt="">
                        </div>
                        <div class="nav__menu_item"
                             v-if="$store.state.sites.sites.length < 1">
                            <a class="nav__menu_link" href="{{ route('site.create') }}">@lang('Добавить сайт')</a>
                        </div>
                        <div class="nav__menu_item" v-for="(site, index) in $store.state.sites.sites" :key="index">
                            <a class="nav__menu_link" :href="site.url">@{{ site.link }}</a>
                        </div>
                    @endauth
                    <div class="nav__item_wrap">
                        <a href="{{ route('tariff.index') }}">@lang('Тарифы')</a>
                        <img class="nav__item_img" src="{{ asset('images/tarif.svg') }}" alt="">
                    </div>
                    @auth
                        <div class="header__subscription header__mobile_sub">
                            <h3 class="header__subscription_title">@lang('Тариф') "@lang(Auth::user()->tariff->name)
                                "</h3>
                            <a href="{{ route('tariff.index') }}"
                               class="header__subscription_link">@lang('Повысить тариф')</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <div class="tooltip_templates">
            <span id="tooltip_content" class="general__tooltip">
                <p>@lang('Информация')</p>
                <a target="_blank" href="https://push-gun.net/ru/manual/kak-vstavit-kod-dlya-push-uvedomlenij-na-sajte-s-pomoshyu-google-tag-manager">
                @lang('Информация о сервисе web push рассылок')</a>
                <a target="_blank" href="https://push-gun.net/ru/manual/kak-sdelat-push-uvedomlenie-na-sajte">
                @lang('Настройки рассылок')</a>
            </span>
    </div>
    <footer class="footer">
        <a href="{{ route('manual.index') }}">@lang('База знаний')</a>
        <a href="{{ route('ticket.index') }}">@lang('Тех. поддержка')</a>
        <a href="{{ route('page.privacy') }}">@lang('Политика конфиденциальности')</a>
    </footer>
</div>
</body>
</html>
