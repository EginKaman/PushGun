@extends('layouts.app')
@section('title', __('Тарифы'))
    @push('scripts')
        <script src="https://widget.cloudpayments.ru/bundles/cloudpayments"></script>
    @endpush
@section('content')
    <main class="main single-mail">
        <div class="container">
            <section class="tariffs">
                <div class="general__title">
                    <h1 class="title">@lang('Тарифы')</h1>
                </div>
                <div class="mail__time-sent">
                    <p>@lang('Текущий план'): @lang($tariff->name)</p>
                </div>

                <!-- Убираю таблички с раздела тариф -->
                <!--            <div class="tariff-wrap">

                        <div class="tariff tariff-fs">
                            <div class="tariff-text">
                                <h3 class="tariff-title">@lang('Подписка 1000')</h3>
                                <strong class="tariff-subtitle">@lang('до 1 000 подписчиков')</strong>
                                <ul class="tariff-offer">
                                    <li>@lang('Неограниченное количество web push сообщений')</li>
                                    <li>@lang('Поддержка HTTP и HTTPS')</li>
                                    <li>@lang('Рассылка RSS')</li>
                                    <li>@lang('Персонализация сообщений')</li>
                                </ul>
                            </div>
                            <div class="tariff-bottom">
                                <span class="tariff-price">@lang('Бесплатно')</span>

                                <div class="button_green tariff-bay">
                                    <span class="green_button_circle">
                                    </span>
                                    <button type="submit" class="button_green_inner">
                                        <p class="rb_button_text_container">
                                            @lang('Активировать')
                                        </p>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <div class="tariff tariff-sec">
                            <tariff-form :tariffs="{{ $tariffs }}"
                                public_id="{{ config('services.cloud_payments.public_id') }}"
                                account_id="{{ auth()->id() }}"></tariff-form>
                        </div>

                    </div>

                </div>-->


                <div class="general__title sec">
                    <h2 class="title">@lang('Мои подписки')</h2>
                </div>


                <div class="follows-wrap">
                    @if ($user->tariff_expired_at)
                        <div class="follows-row">
                            <div class="follows-left">
                                <span class="follows-text">@lang('Ближайшая следующая оплата'):</span>
                            </div>
                            <div class="follows-right">
                                <span class="follows-text">{{ $user->tariff_expired_at }}</span>
                            </div>
                        </div>
                    @endif
                </div>


                <div class="follows-wrap">
                    <div class="follows-top">
                        <div class="follows-title">
                            <span class="follows-title__hero">
                                @lang('Тарифный план'): <b>@lang($tariff->name)</b>
                            </span>
                            <span class="follows-title__subtitle">
                                @lang('Количество подписчиков'): {{ $tariff->max_followers }}
                            </span>
                        </div>
                        <a href="" class="follows-change__tariff">@lang('Выбрать другой тарифный план')</a>
                    </div>
                    <div class="follows-row bb-1">
                        <div class="follows-left">
                            <span class="follows-text">@lang('Статус'):</span>
                        </div>
                        <div class="follows-right">
                            <span class="follows-text green">@lang('Активен')</span>
                        </div>
                    </div>
                    @if ($user->tariff_expired_at)
                        <div class="follows-row bb-1">
                            <div class="follows-left">
                                <span class="follows-text">@lang('Активен до'):</span>
                            </div>
                            <div class="follows-right">
                                <span class="follows-text">{{ $user->tariff_expired_at }}</span>
                            </div>
                        </div>
                        {{-- <div class="follows-row bb-1"> --}}
                        {{-- <div class="follows-left"> --}}
                        {{-- <span class="follows-text">@lang('Пакет активирован'):</span> --}}
                        {{-- </div> --}}
                        {{-- <div class="follows-right"> --}}
                        {{-- <span class="follows-text">{{ $user->payment->created_at }}</span> --}}
                        {{-- </div> --}}
                        {{-- </div> --}}
                    @endif
                    @if ($tariff->price > 0)
                        <div class="follows-row bb-1">
                            <div class="follows-left">
                                <span class="follows-text">@lang('Размер платежа'):</span>
                            </div>
                            <div class="follows-right">
                                <span class="follows-text">{{ $tariff->price }} @lang('руб')</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="tariffs-fake create-push-mail">
                    <tariffs-component :tariffs_email="{{ json_encode($tariffs_email) }}"
                        :user="{{ json_encode($user) }}" public_id="{{ config('services.cloud_payments.public_id') }}"
                        account_id="{{ auth()->id() }}">
                    </tariffs-component>
                </div>
            </section>
        </div>
    </main>
@endsection
