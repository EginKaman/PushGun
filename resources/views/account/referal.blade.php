@extends('layouts.app')
@section('title', __('Реферальная программа'))
@section('content')
<main class="main referal">
    <div class="container">
        <div class="general__title">
            <div class="title">
                Реферальная программа
            </div>
            <p class="sub-title">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
        </div>
        <div class="referal__wrapper">
            <div class="referal__block">
                <div class="referal__block__wrapper">
                    <p>Ваша реферальная ссылка</p>
                    <input placeholder="https://" data-id="refferal_link__text" class="copy_command__text" readonly value="{{$refferal_link}}" type="text">
                    <div class="button_green mr-24 copy_command__button" data-input-id="refferal_link__text">
                        <span class="green_button_circle"></span>
                        <a class="button_green_inner">
                            <p class="button_text_container">
                                <img src="{{asset('images/sender.svg')}}" alt="">Скопировать
                            </p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="general__stats_left">
                <div class="general__stats_left-item" style="background: #3B8378;">
                    <h3>{{$referral_count}}</h3>
                    <div class="mb-10">
                        <p class="medium">Зарегестрировавшихся</p>
                    </div>
                </div>
                <div class="general__stats_left-item" style="background: #5BA4D7;">
                    <h3>{{$payments_made}}</h3>
                    <p class="medium mb-10">Совершивших платеж</p>
                </div>
                <div class=" general__stats_left-item" style="background: #FF7226;">
                    <h3>{{$bonus_balance}}</h3>
                    <div class="mb-10">
                        <p class="medium mb-10">Рублей ваш бонус</p>
                    </div>
                </div>
            </div>
            <withdrawal-bonus></withdrawal-bonus>
        </div>
    </div>
</main>

@endsection