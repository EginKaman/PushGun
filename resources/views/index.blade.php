<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('Главная') | {{ config('app.name', 'Laravel') }}</title>

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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div id="app">
    <header class="header-landing">
        <div class="container">
            <div class="header-landing__wrapper">
                <a href="{{ route('index') }}" class="logo-light">
                    <picture>
                        <source srcset="{{ asset('images/logo.webp') }}" type="image/webp">
                        <img src="{{ asset('images/logo.png') }}" alt="logo">
                    </picture>
                </a>
                <a href="{{ route('index') }}" class="logo-dark">
                    <picture>
                        <source srcset="{{ asset('images/dark-logo.webp') }}" type="image/webp">
                        <img src="{{ asset('images/dark-logo.svg') }}" alt="logo">
                    </picture>
                </a>
                <ul class="header-landing__wrapper__menu">
                    <li><a href="#aboutus">@lang('О нас')</a></li>
                    <li><a href="#price">@lang('Цена')</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
                <div class="lang-toggle">
                    <span class="lang-current">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                    <img src="{{ asset('images/next.svg') }}" alt="arrow-down">
                    <ul>
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="header-landing__wrapper__links">
                    <login-button classes="header-landing__wrapper__links_enter" action="{{ route('login') }}">
                    </login-button>
                    <register-button classes="header-landing__wrapper__links_reg" action="{{ route('register') }}">
                    </register-button>

                    <div class="arrow">
                        <div class="text">@lang('До 1000 подписчиков бесплатно')</div>
                        <div class="svg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 53.8 37.3"
                                 xmlns:v="https://vecta.io/nano">
                                <path
                                    d="M50 2.8a.94.94 0 0 0-1-1 .94.94 0 0 0-1 1h2zm-48.8 31c-.5-.1-1.1.2-1.2.7s.2 1.1.7 1.2l.5-1.9zm21.3-3.2c1.1 3.7 3.4 5.9 6.4 6.6 3 .6 6.3-.4 9.4-2.8C44.6 29.6 50 19 50 2.8h-2c0 15.8-5.3 25.7-10.9 30-2.8 2.2-5.6 2.9-7.8 2.4s-4-2.1-4.9-5.2l-1.9.6zm2-.6c-.5-1.7-1.1-3-1.7-3.9-.7-.9-1.5-1.4-2.5-1.4-.9 0-1.8.6-2.5 1.1-.8.6-1.6 1.4-2.4 2.2-3.4 3.3-7.7 7.3-14.1 5.8l-.5 2c7.6 1.9 12.6-3.1 15.9-6.2.9-.8 1.6-1.5 2.2-2 .7-.5 1.1-.7 1.4-.7.2 0 .4 0 .8.6s.9 1.6 1.4 3.2l2-.7z"/>
                                <path
                                    d="M44.6 9.4c-.2 0-.4 0-.5-.1-.5-.3-.6-.9-.3-1.4L48.2.5c.3-.5.9-.6 1.4-.3s.6.9.3 1.4L45.5 9c-.3.3-.6.4-.9.4z"/>
                                <path
                                    d="M52.8 9.6c-.4 0-.7-.2-.9-.5l-3.8-7.5c-.3-.5-.1-1.1.4-1.3.5-.3 1.1-.1 1.3.4l3.8 7.5c.3.5.1 1.1-.4 1.3-.1 0-.2.1-.4.1z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="hamburger-menu">
                    <input id="menu__toggle" type="checkbox"/>
                    <label class="menu__btn" for="menu__toggle"><span></span></label>
                    <ul class="menu__box">
                        <li><a class="menu__item" href="#aboutus">@lang('О нас')</a></li>
                        <li><a class="menu__item" href="#price">@lang('Цена')</a></li>
                        <li><a class="menu__item" href="#faq">@lang('FAQ')</a></li>
                        <li>
                            <login-button classes="menu__item" action="{{ route('login') }}"></login-button>
                        </li>
                        <li>
                            <register-button classes="menu__item" action="{{ route('register') }}">
                            </register-button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <section class="section1">
        <div class="container">
            <div class="section1__content">
                <div class="section1__content__slider">
                    <div>
                        <h1>@lang('PushGun — пушечный сервис уведомлений')</h1>
                        <p>@lang('Общайся с клиентами прямо со своего браузера с помощью push-уведомлений')</p>
                    </div>
                    <div>
                        <h1>@lang('Автоматизация маркетинга с сервисом PushGun')</h1>
                        <p>@lang('Охватите больше аудитории с пуш-уведомлениями и увеличивайте прибыль')</p>
                    </div>
                </div>
                <div class="hero-img--wrap">
                    <figure class="hero-img1">
                        <picture>
                            <source srcset="{{ asset('images/hero1.webp') }}" type="image/webp">
                            <img src="{{ asset('images/hero1.png') }}" alt="push" class="">
                        </picture>
                    </figure>
                    <figure class="hero-img2">
                        <picture>
                            <source srcset="{{ asset('images/hero2.webp') }}" type="image/webp">
                            <img src="{{ asset('images/hero2.png') }}" alt="push" class="">
                        </picture>
                    </figure>
                    <figure class="hero-img3">
                        <picture>
                            <source srcset="{{ asset('images/hero3.webp') }}" type="image/webp">
                            <img src="{{ asset('images/hero3.png') }}" alt="push" class="">
                        </picture>
                    </figure>
                    <figure class="hero-img4">
                        <picture>
                            <source srcset="{{ asset('images/hero4.webp') }}" type="image/webp">
                            <img src="{{ asset('images/hero4.png') }}" alt="push" class="">
                        </picture>
                    </figure>
                </div>
            </div>
            <a href="#aboutus" class="btn_dwn"> <span class="whiteBg"></span>
                <picture>
                    <source srcset="{{ asset('images/btn_down.webp') }}" type="image/webp">
                    <img src="{{ asset('images/btn_down.png') }}" alt="down">
                </picture>
            </a>
        </div>
    </section>
    <section class="section8" id="browsers">
        <div class="container">
            <h2 class="section8__title">@lang('Push-уведомления работают со всеми') <br> @lang('современными
                    браузерами')</h2>
            <div class="section8__wrap">
                <div class="browser"><img src="{{ asset('images/browsers/chrome.png') }}"></div>
                <div class="browser"><img src="{{ asset('images/browsers/firefox.png') }}"></div>
                <div class="browser"><img src="{{ asset('images/browsers/opera.png') }}"></div>
                <div class="browser"><img src="{{ asset('images/browsers/android.png') }}"></div>
                <div class="browser"><img src="{{ asset('images/browsers/safari.png') }}"></div>
            </div>
        </div>
    </section>
    <section class="section2" id="aboutus">
        <div class="container">
            <h2 class="section2__title">@lang('Возможности и преимущества')</h2>
            <p class="section2__descr"> {!! trans('home.pushes') !!} </p>
            <div class="section2__itemsWrapper">
                <div class="section2__itemsWrapper__item">
                    <svg width="85" height="71" viewBox="0 0 85 71" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M68.6911 46.5928C72.4502 46.5928 75.4974 43.4744 75.4974 39.6275V7.09706C75.4974 3.25015 72.45 0.131714 68.6911 0.131714H38.9896C35.2305 0.131714 32.1831 3.1791 32.1831 6.93819V38.7262C32.1831 42.4853 35.2305 45.5325 38.9896 45.5325H64.5037C65.069 45.5325 65.6127 45.7495 66.0226 46.1386L66.1112 46.2228C66.1116 46.2226 68.1575 46.5928 68.6911 46.5928Z"
                            fill="url(#paint0_linear)"/>
                        <path
                            d="M78.1936 0.131714H67.3631C71.1222 0.131714 74.1694 3.1791 74.1694 6.93802V38.726C74.1694 42.4851 71.122 45.5325 67.3631 45.5325C66.8295 45.5325 66.3721 45.8121 66.1113 46.2228L77.0652 56.621C77.5812 57.1109 78.4229 56.6567 78.2969 55.9565L76.62 46.6448C76.5155 46.0652 76.9609 45.5325 77.5498 45.5325H78.1938C81.9529 45.5325 85.0001 42.4851 85.0001 38.726V6.93802C84.9999 3.17893 81.9525 0.131714 78.1936 0.131714Z"
                            fill="#A9D0EA"/>
                        <path
                            d="M42.3104 11.5845H7.66511C3.43188 11.5845 0 15.0163 0 19.2496V50.4849C0 54.7183 3.43171 58.15 7.66511 58.15H8.39027C9.05333 58.15 9.55503 58.75 9.43749 59.4026L9.33423 59.976L19.0918 59.9759L19.9742 59.1836C20.7154 58.5181 21.6765 58.15 22.6728 58.15H23.0821H24.4103H42.3102C46.5436 58.15 49.9754 54.7182 49.9754 50.4849V19.2496C49.9755 15.0163 46.5437 11.5845 42.3104 11.5845Z"
                            fill="url(#paint1_linear)"/>
                        <path
                            d="M10.5386 58.8327L9.33433 59.9759L7.549 69.889C7.40689 70.6776 8.35484 71.1891 8.93606 70.6374L21.3718 58.8326C21.8335 58.3943 22.4457 58.1499 23.0822 58.1499H12.2491C11.6126 58.1502 11.0001 58.3944 10.5386 58.8327Z"
                            fill="#3B8378"/>
                        <path
                            d="M51.8152 11.5845H40.9822C45.2156 11.5845 48.6473 15.0163 48.6473 19.2496V50.4849C48.6473 54.7183 45.2154 58.15 40.9822 58.15H51.8152C56.0486 58.15 59.4803 54.7183 59.4803 50.4849V19.2496C59.4805 15.0163 56.0486 11.5845 51.8152 11.5845Z"
                            fill="#3B8378"/>
                        <path
                            d="M36.8743 21.3354C34.4098 21.3354 32.1692 22.3257 30.499 23.9427C30.0738 24.3543 29.4064 24.3543 28.9812 23.9427C27.311 22.3257 25.0704 21.3354 22.6059 21.3354C17.4407 21.3354 13.2534 25.6807 13.2534 31.0409C13.2534 40.0379 23.6626 46.4163 27.939 48.6571C29.0671 49.2483 30.4131 49.2483 31.5412 48.6571C35.8176 46.4164 46.2268 40.0379 46.2268 31.0409C46.2268 25.6806 42.0395 21.3354 36.8743 21.3354Z"
                            fill="#F0F7FF"/>
                        <defs>
                            <linearGradient id="paint0_linear" x1="31.875" y1="0.0833362" x2="72.25" y2="46.8333"
                                            gradientUnits="userSpaceOnUse">
                                <stop stop-color="#D6E9F5"/>
                                <stop offset="1" stop-color="#ADD2EB"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear" x1="-9.22226e-07" y1="16.375" x2="32.5833"
                                            y2="48.9584" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#479E91"/>
                                <stop offset="1" stop-color="#3F8D81"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <h3 class="section2__itemsWrapper__item__title">@lang('Предложение подписки')</h3>
                </div>
                <div class="section2__itemsWrapper__item">
                    <svg width="85" height="69" viewBox="0 0 85 69" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M65.2548 0.82251H7.49162C3.35418 0.82251 0 4.17669 0 8.3143V41.6152C0 45.7528 3.35418 49.1068 7.49162 49.1068H10.6487C11.6198 49.1068 12.5172 49.6241 13.0038 50.4643L21.3159 64.8152C22.1545 66.2631 24.2448 66.2631 25.0833 64.8152L33.3954 50.4643C33.8821 49.6241 34.7794 49.1068 35.7505 49.1068H65.2544C69.392 49.1068 72.7461 45.7527 72.7461 41.6152V8.3143C72.7466 4.17669 69.3924 0.82251 65.2548 0.82251Z"
                            fill="url(#paint0_linear)"/>
                        <path
                            d="M22.5757 50.4643L17.7898 58.7271L21.316 64.8152C22.1545 66.263 24.2448 66.263 25.0834 64.8152L33.3956 50.4643C33.8822 49.6241 34.7797 49.1068 35.7507 49.1068H24.9308C23.9598 49.1068 23.0623 49.6241 22.5757 50.4643Z"
                            fill="#A9D0EA"/>
                        <path
                            d="M65.2547 0.82251H54.4348C58.5724 0.82251 61.9264 4.17669 61.9264 8.3143V41.6152C61.9264 45.7528 58.5723 49.1068 54.4348 49.1068H65.2547C69.3923 49.1068 72.7463 45.7527 72.7463 41.6152V8.3143C72.7465 4.17669 69.3923 0.82251 65.2547 0.82251Z"
                            fill="#A9D0EA"/>
                        <path
                            d="M84.9068 66.6858L80.3274 56.313C80.052 55.6893 80.0351 54.9836 80.2731 54.3447C81.0267 52.3228 81.4225 50.1269 81.3818 47.8331C81.2118 38.2666 73.3652 30.4999 63.7974 30.4236C53.8884 30.3444 45.8403 38.3936 45.921 48.3029C46.0004 58.0419 54.0417 65.9559 63.7808 65.8868C66.1957 65.8697 68.4955 65.3692 70.5889 64.4782C71.1697 64.231 71.8209 64.2072 72.4199 64.4063L83.6017 68.1212C84.4752 68.4111 85.2785 67.5277 84.9068 66.6858Z"
                            fill="url(#paint1_linear)"/>
                        <path
                            d="M84.9069 66.686L80.3275 56.3131C80.0523 55.6894 80.0352 54.9837 80.2733 54.3449C81.0268 52.3229 81.4227 50.1271 81.3819 47.8332C81.2119 38.2667 73.3653 30.5 63.7975 30.4237C63.0652 30.4178 62.3434 30.4575 61.634 30.5379C64.0391 31.8341 66.1759 33.7026 67.8149 36.1014C73.4057 44.2835 71.2106 55.4523 62.9397 60.9101C60.5375 62.4952 57.8766 63.415 55.1812 63.7139C57.7395 65.1173 60.6734 65.9092 63.7809 65.8871C66.1958 65.87 68.4956 65.3695 70.5892 64.4784C71.17 64.2313 71.8212 64.2075 72.4202 64.4066L83.602 68.1215C84.4753 68.4112 85.2786 67.5278 84.9069 66.686Z"
                            fill="#3B8378"/>
                        <path
                            d="M63.1302 46.242C62.5542 46.806 61.8342 47.088 60.9702 47.088C60.1062 47.088 59.3802 46.8 58.7922 46.224C58.2162 45.648 57.9282 44.946 57.9282 44.118C57.9282 43.29 58.2162 42.588 58.7922 42.012C59.3802 41.436 60.1062 41.148 60.9702 41.148C61.8342 41.148 62.5542 41.436 63.1302 42.012C63.7062 42.576 63.9942 43.278 63.9942 44.118C63.9942 44.958 63.7062 45.666 63.1302 46.242ZM59.2062 52.092L67.4142 42.966L68.5122 43.578L60.2862 52.722L59.2062 52.092ZM60.1422 44.946C60.3582 45.162 60.6282 45.27 60.9522 45.27C61.2762 45.27 61.5462 45.162 61.7622 44.946C61.9782 44.718 62.0862 44.442 62.0862 44.118C62.0862 43.794 61.9782 43.524 61.7622 43.308C61.5462 43.092 61.2762 42.984 60.9522 42.984C60.6282 42.984 60.3582 43.092 60.1422 43.308C59.9382 43.524 59.8362 43.794 59.8362 44.118C59.8362 44.442 59.9382 44.718 60.1422 44.946ZM69.2142 53.352C68.6382 53.928 67.9182 54.216 67.0542 54.216C66.1902 54.216 65.4702 53.928 64.8942 53.352C64.3182 52.776 64.0302 52.074 64.0302 51.246C64.0302 50.418 64.3182 49.716 64.8942 49.14C65.4702 48.564 66.1902 48.276 67.0542 48.276C67.9182 48.276 68.6382 48.564 69.2142 49.14C69.7902 49.716 70.0782 50.418 70.0782 51.246C70.0782 52.074 69.7902 52.776 69.2142 53.352ZM66.2442 52.074C66.4602 52.29 66.7302 52.398 67.0542 52.398C67.3782 52.398 67.6422 52.284 67.8462 52.056C68.0622 51.828 68.1702 51.558 68.1702 51.246C68.1702 50.922 68.0622 50.652 67.8462 50.436C67.6422 50.208 67.3782 50.094 67.0542 50.094C66.7302 50.094 66.4602 50.208 66.2442 50.436C66.0402 50.652 65.9382 50.922 65.9382 51.246C65.9382 51.57 66.0402 51.846 66.2442 52.074Z"
                            fill="white"/>
                        <path
                            d="M64.8492 13.7232H7.89738C7.18883 13.7232 6.61475 13.149 6.61475 12.4406C6.61475 11.7322 7.18899 11.158 7.89738 11.158H64.849C65.5576 11.158 66.1317 11.7322 66.1317 12.4406C66.1318 13.1488 65.5576 13.7232 64.8492 13.7232Z"
                            fill="#F0F7FF"/>
                        <path
                            d="M64.8492 24.3421H7.89738C7.18883 24.3421 6.61475 23.7679 6.61475 23.0595C6.61475 22.3511 7.18899 21.7769 7.89738 21.7769H64.849C65.5576 21.7769 66.1317 22.3511 66.1317 23.0595C66.1318 23.7679 65.5576 24.3421 64.8492 24.3421Z"
                            fill="#F0F7FF"/>
                        <path
                            d="M42.1011 34.9611H7.89738C7.18883 34.9611 6.61475 34.3869 6.61475 33.6785C6.61475 32.9701 7.18899 32.3959 7.89738 32.3959H42.1009C42.8095 32.3959 43.3836 32.9701 43.3836 33.6785C43.3837 34.3869 42.8095 34.9611 42.1011 34.9611Z"
                            fill="#F0F7FF"/>
                        <defs>
                            <linearGradient id="paint0_linear" x1="-0.517492" y1="0.754747" x2="53.7002"
                                            y2="76.0279" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#D6E9F5"/>
                                <stop offset="1" stop-color="#ADD2EB"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear" x1="45.9204" y1="34.1605" x2="71.3415" y2="59.6398"
                                            gradientUnits="userSpaceOnUse">
                                <stop stop-color="#479E91"/>
                                <stop offset="1" stop-color="#3F8D81"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <h3 class="section2__itemsWrapper__item__title">@lang('Уведомление о скидках и распродажах')
                    </h3>
                </div>
                <div class="section2__itemsWrapper__item">
                    <svg width="85" height="75" viewBox="0 0 85 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.9"
                              d="M42.5 0.323608C19.0279 0.323608 0 15.1161 0 33.3634C0 41.1437 3.45977 48.2956 9.24807 53.941C9.93106 54.6072 10.1882 55.598 9.93703 56.5184C7.90085 63.9783 3.18667 70.6277 1.06665 73.3604C0.644805 73.9042 1.04341 74.6933 1.73138 74.676C6.4346 74.5587 19.6284 73.5059 27.617 65.6516C28.2675 65.0121 29.2007 64.7594 30.0882 64.9699C34.0146 65.9009 38.1816 66.403 42.5 66.403C65.9721 66.403 85 51.6105 85 33.3632C85 15.1159 65.9721 0.323608 42.5 0.323608Z"
                              fill="url(#paint0_linear)"/>
                        <path
                            d="M42.5 0.323608C40.6758 0.323608 38.8783 0.413257 37.1147 0.586577C58.0442 2.64401 74.2295 16.5342 74.2295 33.3634C74.2295 50.1906 58.0482 64.0796 37.1222 66.1395C38.8836 66.3127 40.6781 66.4031 42.5001 66.4031C65.9722 66.4031 85.0001 51.6106 85.0001 33.3634C85 15.1159 65.9721 0.323608 42.5 0.323608Z"
                            fill="#A9D0EA"/>
                        <path
                            d="M55.3179 26.1405C54.9922 26.1405 54.6663 26.0173 54.4163 25.7703L43.0915 14.5817C42.7668 14.2613 42.2371 14.2614 41.9113 14.5827L30.5184 25.7729C30.0133 26.2693 29.2012 26.2625 28.7043 25.7567C28.2079 25.2513 28.2151 24.439 28.7206 23.9426L40.1119 12.754C41.4292 11.4554 43.575 11.4554 44.8936 12.7557L56.2194 23.9453C56.7233 24.4432 56.7281 25.2551 56.2302 25.7593C55.9795 26.0133 55.6488 26.1405 55.3179 26.1405Z"
                            fill="#3B8378"/>
                        <path
                            d="M57.0926 51.5045H27.8452C26.0696 51.5045 24.5438 50.2451 24.2069 48.502L20.2317 27.9238H64.7061L60.7309 48.502C60.394 50.2451 58.868 51.5045 57.0926 51.5045Z"
                            fill="url(#paint1_linear)"/>
                        <path
                            d="M53.0805 27.9238L49.1053 48.502C48.7686 50.2451 47.2426 51.5045 45.467 51.5045H57.0928C58.8683 51.5045 60.3942 50.2451 60.731 48.502L64.7063 27.9238H53.0805Z"
                            fill="#3B8378"/>
                        <path
                            d="M65.7741 29.4866H19.226C17.6125 29.4866 16.3044 28.1786 16.3044 26.5651C16.3044 24.9516 17.6125 23.6436 19.226 23.6436H65.7739C67.3875 23.6436 68.6955 24.9516 68.6955 26.5651C68.6957 28.1786 67.3876 29.4866 65.7741 29.4866Z"
                            fill="#3B8378"/>
                        <path
                            d="M32.5091 44.7451L30.2727 34.4245C30.1228 33.7322 30.5623 33.0493 31.2547 32.8993C31.9477 32.7489 32.6298 33.189 32.7799 33.8813L35.0163 44.2019C35.1662 44.8941 34.7268 45.5771 34.0343 45.727C33.3407 45.8778 32.6589 45.4359 32.5091 44.7451Z"
                            fill="#CDE2F0"/>
                        <path
                            d="M42.5002 45.7554C41.7916 45.7554 41.2175 45.1812 41.2175 44.4728V34.1523C41.2175 33.4437 41.7918 32.8696 42.5002 32.8696C43.2086 32.8696 43.7828 33.4439 43.7828 34.1523V44.4728C43.7828 45.1813 43.2087 45.7554 42.5002 45.7554Z"
                            fill="#CDE2F0"/>
                        <path
                            d="M50.966 45.7263C50.2735 45.5764 49.8339 44.8934 49.984 44.2011L52.2202 33.8806C52.3701 33.1883 53.0519 32.7477 53.7454 32.8986C54.4378 33.0486 54.8774 33.7315 54.7274 34.4238L52.4911 44.7444C52.3412 45.4358 51.6587 45.8767 50.966 45.7263Z"
                            fill="#CDE2F0"/>
                        <path
                            d="M23.0884 62.761C21.3529 62.0669 19.3815 62.4899 18.0477 63.7995C12.7878 68.964 5.75242 72.4205 0.997729 73.4637C0.695083 73.9986 1.08588 74.6921 1.73135 74.676C6.43458 74.5586 19.6283 73.5059 27.617 65.6515C28.2673 65.012 29.2001 64.7595 30.0875 64.9697C27.6545 64.3931 25.3145 63.6514 23.0884 62.761Z"
                            fill="#EAF4FB"/>
                        <defs>
                            <linearGradient id="paint0_linear" x1="-0.604662" y1="0.246189" x2="60.8865"
                                            y2="87.5558" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#D6E9F5"/>
                                <stop offset="1" stop-color="#ADD2EB"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear" x1="20.2317" y1="30.2582" x2="33.6088" y2="54.6885"
                                            gradientUnits="userSpaceOnUse">
                                <stop stop-color="#479E91"/>
                                <stop offset="1" stop-color="#3F8D81"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <h3 class="section2__itemsWrapper__item__title">@lang('Напоминания о брошенной корзине')</h3>
                </div>
                <div class="section2__itemsWrapper__item">
                    <svg width="73" height="85" viewBox="0 0 73 85" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M46.3822 85C48.8153 85 50.7879 83.0276 50.7879 80.5943V4.40572C50.7879 1.97243 48.8153 0 46.3822 0H4.52315C2.09003 0 0.117432 1.97243 0.117432 4.40572V80.5943C0.117432 83.0274 2.08986 85 4.52315 85H46.3822Z"
                            fill="url(#paint0_linear)"/>
                        <path
                            d="M56.22 0H45.5105C47.9436 0 49.9162 1.97243 49.9162 4.40572V80.5944C49.9162 83.0276 47.9438 85.0002 45.5105 85.0002H56.22C58.6531 85.0002 60.6257 83.0277 60.6257 80.5944V4.40572C60.6257 1.97243 58.6531 0 56.22 0V0Z"
                            fill="#A9D0EA"/>
                        <path
                            d="M50.7878 7.01379H9.58307C8.22904 7.01379 7.13135 8.11149 7.13135 9.46551V69.727C7.13135 71.081 8.22904 72.1787 9.58307 72.1787H50.7878V7.01379Z"
                            fill="#FDFDFD"/>
                        <path
                            d="M49.9162 72.179H51.16C52.514 72.179 53.6117 71.0813 53.6117 69.7272V14.7975H49.916V72.179H49.9162Z"
                            fill="#D0E4F2"/>
                        <path
                            d="M50.7878 7.01379H9.58307C8.22904 7.01379 7.13135 8.11149 7.13135 9.46551V14.7974H50.7878V7.01379Z"
                            fill="#429487"/>
                        <path
                            d="M53.612 14.7974V9.46551C53.612 8.11149 52.5143 7.01379 51.1603 7.01379H49.9165V14.7974H53.612Z"
                            fill="#3B8378"/>
                        <path
                            d="M62.6871 49.5672V27.3099C62.6871 24.838 60.6833 22.8342 58.2115 22.834H31.4264C28.9544 22.834 26.9504 24.838 26.9504 27.3099V49.5672C26.9504 52.0197 28.9232 54.0106 31.3684 54.0418V64.4408C31.3684 65.0931 32.1916 65.379 32.5958 64.8672L40.6075 54.7243C40.9472 54.2943 41.465 54.0433 42.013 54.0433H58.2118C60.6835 54.0428 62.6871 52.039 62.6871 49.5672Z"
                            fill="url(#paint1_linear)"/>
                        <path
                            d="M68.4063 22.834H57.5837C60.0557 22.834 62.0597 24.838 62.0597 27.3099V49.5671C62.0597 52.0391 60.0557 54.0433 57.5837 54.0433H68.4063C70.8783 54.0433 72.8822 52.0393 72.8822 49.5671V27.3099C72.8824 24.838 70.8784 22.834 68.4063 22.834Z"
                            fill="#3B8378"/>
                        <path
                            d="M31.3682 64.4408C31.3682 65.0931 32.1913 65.379 32.5955 64.8672L40.6073 54.7243C40.9469 54.2943 41.4647 54.0435 42.0128 54.0435H31.3682V64.4408Z"
                            fill="#3B8378"/>
                        <path
                            d="M32.4815 80.2061H28.2619C27.5535 80.2061 26.9792 79.6319 26.9792 78.9235C26.9792 78.2151 27.5535 77.6409 28.2619 77.6409H32.4815C33.1899 77.6409 33.7641 78.2151 33.7641 78.9235C33.7641 79.6319 33.1899 80.2061 32.4815 80.2061Z"
                            fill="white"/>
                        <defs>
                            <linearGradient id="paint0_linear" x1="-0.243021" y1="-0.0885062" x2="71.1676"
                                            y2="52.7836" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#D6E9F5"/>
                                <stop offset="1" stop-color="#ADD2EB"/>
                            </linearGradient>
                            <linearGradient id="paint1_linear" x1="26.9504" y1="27.0211" x2="54.8652" y2="49.8594"
                                            gradientUnits="userSpaceOnUse">
                                <stop stop-color="#479E91"/>
                                <stop offset="1" stop-color="#3F8D81"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <h3 class="section2__itemsWrapper__item__title">@lang('Продуктовый маркетинг')</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="business">
        <div class="container">
            <h2 class="business-title">Сценарии уведомлений для вашего бизнеса</h2>
            <div class="business-wrap">
                <ul class="business-items">
                    <li data-tab="1" class="active">Интернет магазины</li>
                    <li data-tab="2">Страховые / Банки</li>
                    <li data-tab="3">Рестораны / Доставка</li>
                    <li data-tab="4">Блоги / СМИ</li>
                    <li data-tab="5">Недвижимость</li>
                </ul>
                <div data-content="1" class="business-content active">
                    <div class="business-content__wrap">
                        <h4>Брошенная корзина</h4>
                        <p>Пользователь положил товары в корзину и ушел с сайта не закончив покупку -
                            уведомление «Вы забыли Ваши товары»</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business-img.svg') }}" alt="image">
                                <h5>Кажется, вы забыли что-то в корзине.</h5>
                            </div>
                            <a href="#" target="_blank">Перейти в корзину</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Дополнительная продажа</h4>
                        <p>Посетитель купил смартфон - через несколько дней отправляем</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/2.svg') }}" alt="image">
                                <h5>Специальное предложение на защитные стекла для смартфона</h5>
                            </div>
                            <a href="#" target="_blank">Посмотреть предложение</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Брошенный просмотр категории</h4>
                        <p>Пользователь смотрел товар в разделе «брюки» - не положил товар в корзину - 20% на все брюки
                            только 2 дня</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/3.svg') }}" alt="image">
                                <h5>Скидка -20% на все брюки</h5>
                            </div>
                            <a href="#" target="_blank">Посмотреть</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Реактивация пользователя</h4>
                        <p>Пользователь был на сайте - не посещал 30 дней - Самые горячие новинки со скидкой</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/4.svg') }}" alt="image">
                                <h5>Кажется, вы забыли что-то в корзине.</h5>
                            </div>
                            <a href="#" target="_blank">Посетить</a>
                        </div>
                    </div>
                </div>
                <div data-content="2" class="business-content">
                    <div class="business-content__wrap">
                        <h4>Брошенная заявка</h4>
                        <p>Пользователь бросил заполнение анкеты на кредитную карту, через несколько минут отправляем
                            предложение дополнить поля анкеты для получения карты</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/5.svg') }}" alt="image">
                                <h5>Заполни анкету и получи <br> расширенный лимит</h5>
                            </div>
                            <a href="#" target="_blank">Заполнить</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Брошенный просмотр категории</h4>
                        <p>Пользователь смотрел или сравнивал продукты, но не начал заполнение анкеты, предложите ему
                            уникальный продукт</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/6.svg') }}" alt="image">
                                <h5>Получи карту с уникальным дизайном</h5>
                            </div>
                            <a href="#" target="_blank">Получить</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Дополнительные продажи</h4>
                        <p>Пользователь не использует все возможности банка, расскажите ему о его привелегиях</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/7.svg') }}" alt="image">
                                <h5>Быстрая отчетность по УСН <br> для наших клиентов</h5>
                            </div>
                            <a href="#" target="_blank">Воспользоваться</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Специальные предложения</h4>
                        <p>Получайте целевые действия из подписчиков, делая специальные предложения</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/8.svg') }}" alt="image">
                                <h5>Скидки от партнеров <br> для наших клиентов</h5>
                            </div>
                            <a href="#" target="_blank">Посетить</a>
                        </div>
                    </div>
                </div>
                <div data-content="3" class="business-content">
                    <div class="business-content__wrap">
                        <h4>Брошенная корзина</h4>
                        <p>Пользователь положил товары в корзину и ушел, не закончив покупку, верните его за счет
                            спецпредложения с помощью сервиса рассылки push уведомлений</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/9.svg') }}" alt="image">
                                <h5>Забери заказ скорее, а то он остынет</h5>
                            </div>
                            <a href="#" target="_blank">Забрать</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Реактивация пользователя</h4>
                        <p>Возвращайте пользователей, которые давно не заходили всякими
                            вкусняшками с помощью сервиса push уведомлений для сайта</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/10.svg') }}" alt="image">
                                <h5>Каждый шестой кусочек за наш счет</h5>
                            </div>
                            <a href="#" target="_blank">Забрать</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Специальные предложения</h4>
                        <p>Создавайте поводы, что бы пользователи приходили к вам с помощью сервиса рассылки пуш
                            уведомлений</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/11.svg') }}" alt="image">
                                <h5>Охладим вас в этот знойтый день</h5>
                            </div>
                            <a href="#" target="_blank">Получить подарок</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Новости и события</h4>
                        <p>Вовлекайте подписчиков в события вашего заведения</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/12.svg') }}" alt="image">
                                <h5>Вечеринка в стиле супергероев <br> в эту пятницу!</h5>
                            </div>
                            <a href="#" target="_blank">Забрать билет</a>
                        </div>
                    </div>
                </div>
                <div data-content="4" class="business-content">
                    <div class="business-content__wrap">
                        <h4>Возвращение читателей</h4>
                        <p>Отправка подписчикам новостей на основе алгоритма интересов от бесплатного сервиса push
                            уведомлений</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/13.svg') }}" alt="image">
                                <h5>Новость из вашей любимой темы</h5>
                            </div>
                            <a href="#" target="_blank">Читать</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Срочные новости</h4>
                        <p>Отправка подписчикам срочных и важных новостей со скоростью 10000 уведомлений/сек</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/14.svg') }}" alt="image">
                                <h5>Самая горячая новость!</h5>
                            </div>
                            <a href="#" target="_blank">Читать</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Продление подписки</h4>
                        <p>Оповещайте вашик подписчиков об окончании срока подписки</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/15.svg') }}" alt="image">
                                <h5>Ваша подписка подходит к концу</h5>
                            </div>
                            <a href="#" target="_blank">Продлить</a>
                        </div>
                    </div>
                </div>
                <div data-content="5" class="business-content">
                    <div class="business-content__wrap">
                        <h4>Брошенная заявка</h4>
                        <p>Пользователь бросил заполнение анкеты на просмотр, через несколько минут отправляем
                            предложение дополнить поля анкеты для записи на просмотр</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/16.svg') }}" alt="image">
                                <h5>Посмотрите лучшие квартиры в этом доме, заполнив анкету</h5>
                            </div>
                            <a href="#" target="_blank">Заполнить</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Брошенный просмотр категории</h4>
                        <p>Пользователь смотрел или сравнивал квартиры, но не начал
                            заполнение анкеты, предложите ему уникальную подборку объектов</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/17.svg') }}" alt="image">
                                <h5>Подборка всех домов в этом районе</h5>
                            </div>
                            <a href="#" target="_blank">Получить</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Дополнительные продажи</h4>
                        <p>Пользователь купил квартиру, предложите ему дополнительный продукт</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/18.svg') }}" alt="image">
                                <h5>Отделка под ключ от партнера</h5>
                            </div>
                            <a href="#" target="_blank">Воспользоваться</a>
                        </div>
                    </div>
                    <div class="business-content__wrap">
                        <h4>Специальные предложения</h4>
                        <p>Переводите подписчиков в покупателей за счет специальных предложений</p>
                        <div class="business-window">
                            <div class="business-window__inner">
                                <img src="{{ asset('images/business/19.svg') }}" alt="image">
                                <h5>Третья комната в подарок только в январе</h5>
                            </div>
                            <a href="#" target="_blank">Посмотреть</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section3">
        <div class="container">
            <h2 class="section3__title">@lang('Зарегистрируйтесь прямо сейчас')</h2>
            <h3 class="section3__descr">
                @lang('Push\'ки могут уже лететь.')
                <span>@lang('Тестовый пакет до 1000 подписчиков бесплатно.')</span>
            </h3>
            <register-now-form action="{{ route('register') }}"></register-now-form>
        </div>
    </section>
    <section class="section4">
        <div class="container">
            <div class="section4__wrapper">
                <h2 class="section4__wrapper__title">@lang('С нами уже'):</h2>
                <p class="section4__wrapper__count">892</p>
                <h2 class="section4__wrapper__title">@lang('клиента')</h2>
            </div>
        </div>
    </section>
    <section class="section5">
        <div class="container">
            <h2 class="section5__title">@lang('Наши партнеры')</h2>
            <div class="section5__wrapper">
                <div
                    class="first section5__wrapper__item section5__wrapper__item_bb section5__wrapper__item_br section5__wrapper__item_mbr section5__wrapper__item_mbb">
                    <picture>
                        <source srcset="{{ asset('images/tinkoff.png') }}" type="image/webp">
                        <img src="{{ asset('images/tinkoff.png') }}" alt="" class="section5__wrapper__item__logo">
                    </picture>
                </div>
                <div
                    class="second section5__wrapper__item section5__wrapper__item_bb section5__wrapper__item_br section5__wrapper__item_mbb">
                    <picture>
                        <source srcset="{{ asset('images/kaspersky.png') }}" type="image/webp">
                        <img src="{{ asset('images/kaspersky.png') }}" alt="" class="section5__wrapper__item__logo">
                    </picture>
                </div>
                <div
                    class="thirth section5__wrapper__item section5__wrapper__item_bb section5__wrapper__item_mbr section5__wrapper__item_mbb">
                    <picture>
                        <source srcset="{{ asset('images/afisha.png') }}" type="image/webp">
                        <img src="{{ asset('images/afisha.png') }}" alt="" class="section5__wrapper__item__logo">
                    </picture>
                </div>
                <div class="fourth section5__wrapper__item section5__wrapper__item_br section5__wrapper__item_mbb">
                    <picture>
                        <source srcset="{{ asset('images/daily.png') }}" type="image/webp">
                        <img src="{{ asset('images/daily.png') }}" alt="" class="section5__wrapper__item__logo">
                    </picture>
                </div>
                <div class="five section5__wrapper__item section5__wrapper__item_br section5__wrapper__item_mbr">
                    <picture>
                        <source srcset="{{ asset('images/mtc.png') }}" type="image/webp">
                        <img src="{{ asset('images/mtc.png') }}" alt="" class="section5__wrapper__item__logo">
                    </picture>
                </div>
                <div class="six section5__wrapper__item">
                    <picture>
                        <source srcset="{{ asset('images/eldorado.png') }}" type="image/webp">
                        <img src="{{ asset('images/eldorado.png') }}" alt="" class="section5__wrapper__item__logo">
                    </picture>
                </div>
            </div>
        </div>
    </section>
    <section class="section6" id="faq">
        <div class="container">
            <h2 class="section6__title">FAQ</h2>
            <p class="section6__descr">@lang('Ответы на часто задаваемые вопросы')</p>
            <div class="faq"> {!! trans('home.faq') !!} </div>
        </div>
    </section>
    <section class="section7" id="price">
        <div class="container">
            <h2 class="section7__title">
                @lang('Интересуетесь push-уведомлениями, но вы не знаете, как применять их на своем сайте?')
            </h2>
            <p class="section7__descr">
                @lang('Мы поможем вам интегрировать сервис push-уведомлений для сайта или сматфона для вашего бизнеса, настроим автоматический сценарий и расскажем все о сервисе.')
            </p>
            <question-form action="{{ route('mail.question') }}"></question-form>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="footer__wrapper"><a href="{{ route('index') }}">
                    <picture>
                        <source srcset="{{ asset('images/footer_logo.svg') }}" type="image/webp">
                        <img src="{{ asset('images/footer_logo.svg') }}" alt="logo">
                    </picture>
                </a>
                <ul class="footer__wrapper__menu">
                    <li><a href="{{ route('page.privacy') }}">@lang('Политика конфиденциальности')</a></li>
                    <li>
                        <support-button action="{{ route('mail.support') }}"></support-button>
                    </li>
                </ul>
                <div class="footer__wrapper__links">
                    <login-button classes="footer__wrapper__links_enter" action="{{ route('login') }}">
                    </login-button>
                    <register-button classes="footer__wrapper__links_reg" action="{{ route('register') }}">
                    </register-button>
                </div>
            </div>
            <div class="footer__by">
                <p>by</p><a href="https://puzzlepro.ru/" target="_blank"></a>
            </div>
        </div>
    </footer>
</div>
</body>

</html>
