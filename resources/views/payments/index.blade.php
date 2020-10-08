@extends('layouts.app')
@section('title', __('Заказы'))
@section('content')

    <main class="main">
        <div class="container">
            <section class="payment">
                <div class="general__title">
                    <h1 class="title">@lang('История платежей')</h1>
                </div>
                <div class="mail__time-sent">
                    <p></p>
                </div>

                <div class="payment-wrap">

                    <div class="payment-price">
                        <div class="payment-row light-blue">
                            <div class="payment-left">
                                <span class="payment-text">@lang('Название продукта')</span>
                            </div>
                            <div class="payment-right">
                                <span class="payment-text">@lang('Номер заказа')</span>
                            </div>
                            <div class="payment-right">
                                <span class="payment-text">@lang('Стоимость')</span>
                            </div>
                            <div class="payment-right">
                                <span class="payment-text">@lang('Дата')</span>
                            </div>
                        </div>
                        @foreach($user->payments as $payment)
                            <div class="payment-row">
                                <div class="payment-left">
                                    <span class="payment-text">{{ $payment->tariff->name }} - {{ $payment->tariff->max_followers }} @lang('подписчиков')</span>
                                </div>
                                <div class="payment-right">
                                    <span class="payment-text"><b>№{{ $payment->transaction_id }}</b></span>
                                </div>
                                <div class="payment-right">
                                    <span class="payment-text"><b>{{ $payment->amount }} руб</b></span>
                                </div>
                                <div class="payment-right">
                                    <span class="payment-text"><b>{{ $payment->created_at }}</b></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </main>

@endsection
