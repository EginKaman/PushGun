@extends('layouts.app')
@section('title', __('Главная'))
@section('content')
    <main class="main">
        <div class="container">
            @if (session('verified', false))
                <div class="auth-confirm">
                    <p>E-Mail успешно подтвержден!</p>
                </div>
                <script>
                    setTimeout(() => {
                        let closeAuth = document.querySelector('.auth-confirm').remove()
                    }, 4000);

                </script>
            @endif
            <section class="general">
                <div class="general__title">
                    <h1 class="title">@lang('Сервис рассылок PushGun')</h1>
                    <p data-tooltip-content="#tooltip_content" class="pointBlock__circle-2 general__info tooltip">!</p>
                </div>
                <div class="general__status">
                    @if ($user->tariff->max_followers > 0)
                        <div class="general__subs">
                            <p class="">@lang('Подписчиков'): <span>{{ $sites->sum('push_subscriptions_count') }}</span>
                                @lang('из') {{ $user->tariff->max_followers }}</p>
                            <p class="percent">
                                {{ round(($sites->sum('push_subscriptions_count') / $user->tariff->max_followers) * 100, 2) }}
                                %
                            </p>
                        </div>
                        <div class="progress">
                            <progress max="100"
                                value="{{ round(($sites->sum('push_subscriptions_count') / $user->tariff->max_followers) * 100, 2) }}"></progress>
                            <div class="progress_bg">
                                <div class="progress_bar"></div>
                            </div>
                        </div>
                    @else
                        <div class="general__subs">
                            <p class="">@lang('Подписчиков'): <span>{{ $sites->sum('push_subscriptions_count') }}</span>
                                @lang('из') @lang('неограниченно')</p>
                        </div>
                    @endif

                    <div class="general__status_info">
                        @empty($user->tariff_expired_at)
                            <p>@lang('Тариф') “@lang($user->tariff->name)”</p>
                        @else
                            <p>
                                @lang('Тариф') “@lang($user->tariff->name)
                                ” @lang('будет продлен') {{ $user->tariff_expired_at }}
                            </p>
                            @endif
                            <a href="{{ route('tariff.index') }}" class="account__bottom_subscribe">@lang('Изменить')</a>
                        </div>
                    </div>
                    <!--<div class="general__stats__tabs">
                                                                                <a class="tabs active" tab-name="tab-3">Push</a>
                                                                            </div>-->
                    <div class="general__stats tab-item tab-3 active">
                        <div class="general__stats_left">
                            <div class="general__stats_left-item stats__item" style="background: #FF808B;">
                                <h3>{{ $sites->sum('push_subscriptions_count') }}</h3>
                                <div class="mb-10">
                                    <p class="medium">@lang('активных подписчиков')</p>
                                    <p class="semibold">
                                        @lang('за сегодня'): {{ $sites->sum('today_subscriptions_count') }}
                                    </p>
                                </div>
                            </div>
                            <div class="general__stats_left-item" style="background: #9698D5;">
                                <h3>{{ $pushes->sum('delivered') }}</h3>
                                @if ($pushes->sum('delivered') > 0)
                                    <p class="medium mb-10">
                                        {{ round(($pushes->sum('delivered') / $pushes->sum('sent')) * 100, 2) }}
                                        % @lang('доставлено')
                                    </p>
                                @else
                                    <p class="medium mb-10">0% @lang('доставлено')</p>
                                @endif
                            </div>
                            <div class=" general__stats_left-item" style="background: #4AB731;">
                                <h3>{{ $sites->sum('transitions_count') }}</h3>
                                <div class="mb-10">
                                    @if ($pushes->sum('delivered') > 0)
                                        <p class="medium">
                                            {{ round(($sites->sum('transitions_count') / $pushes->sum('delivered')) * 100, 2) }}
                                            % @lang('переходов')
                                        </p>
                                    @else
                                        <p class="medium mb-10">0% @lang('переходов')</p>
                                    @endif
                                    <p class="semibold">
                                        @lang('за сегодня'): {{ $sites->sum('today_transitions_count') }}
                                    </p>
                                </div>
                            </div>
                            <div class="general__stats_left-item" style="background: #36C2CF;">
                                <h3>{{ $user->pushes_count }}</h3>
                                <p class="medium mb-10">@lang('рассылок')</p>
                            </div>
                        </div>
                        <div class=" general__stats_right">
                            <div class="general__stats_right-top">
                                <h3>@lang('Статистика последних рассылок')</h3>
                                <chart-nav-component></chart-nav-component>
                            </div>
                            <div class="canvas-container">
                                <statistic-chart-component></statistic-chart-component>
                            </div>
                            <current-statistic-component></current-statistic-component>
                        </div>
                    </div>
                    <h2 class="subtitle">@lang('Мои сайты')</h2>
                    <div class="general__sites">
                        @foreach ($sites as $site)
                            <div class="general__sites_item">
                                <div class="general__sites_item-more">
                                    <div class="general__sites_item-more_imgcontsd">
                                        <img src="{{ asset('images/more.svg') }}" alt="">
                                    </div>

                                    <ul class="general__sites_item_ul">
                                        <li><a href="{{ route('push.create') }}">@lang('Отправить PUSH')</a></li>
                                        <li><a href="{{ route('site.edit', $site) }}">@lang('Настройки сайта')</a></li>
                                        <li>
                                            <site-button-delete action="{{ route('site.destroy', $site) }}">
                                            </site-button-delete>
                                        </li>
                                    </ul>

                                </div>
                                <div style="display: flex; align-items: center">
                                    <a href="{{ route('site.show', ['site' => $site]) }}">
                                        @empty($site->image)
                                            <img class="general__sites_item-img" src="{{ asset('images/site.svg') }}"
                                                alt="{{ $site->link }}">
                                        @else
                                            <img class="general__sites_item-img" src="{{ asset(Storage::url($site->image)) }}"
                                                alt="{{ $site->link }}">
                                        @endempty
                                    </a>
                                    <div class="general__sites_info @if ($site->installed) checkmark @endif">
                                        <a href="{{ route('site.show', $site) }}"
                                            class="account__bottom_subscribe general__sites_title">{{ $site->link }}</a>
                                        <p>@lang('Подписчиков'): <span>{{ $site->push_subscriptions_count }}</span></p>
                                    </div>
                                </div>
                                <ul class="general__sites_ul">
                                    <li><a href="{{ route('push.create') }}"><img
                                                src="{{ asset('images/send-black.svg') }}" alt="">@lang('Отправить PUSH')</a>
                                    </li>
                                    <li><a href="{{ route('site.edit', $site) }}"><img
                                                src="{{ asset('images/setting.svg') }}" alt="">@lang('Настройки сайта')</a>
                                    </li>
                                    <li>
                                        <site-button-delete action="{{ route('site.destroy', $site) }}"></site-button-delete>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
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
                        <a href="{{ route('site.create') }}" class="button_white_inner">
                            <p class="button_text_container">
                                <img class="button-img" src="{{ asset('images/add.svg') }}" alt="">@lang('Добавить новый
                                сайт')
                            </p>
                        </a>
                    </div>
                </section>
            </div>
        </main>
    @endsection
