@extends('layouts.app')
@section('title', __('Создание авторассылки RSS'))
@section('content')
<main class="main savemailing">
    <div class="container">
        <div class="general__title">
            <div class="title">
                RSS рассылки
            </div>
        </div>
        <div class="savemailing__wrapper">
            <div class="savemailing__wrapper__head">
                <p>Название рассылки</p>
                <div class="savemailing__wrapper__head__button">
                    <a style="color: #3B8378;">Запустить <img src="{{asset('images/play.svg')}}" alt=""></a>
                    <a style="color: #5ba4d7;">Редактировать <img src="{{asset('images/pan.svg')}}" alt=""></a>
                    <a>Удалить <img src="{{asset('images/basket.svg')}}" alt=""></a>
                </div>
            </div>
            <div class="savemailing__wrapper__status">
                <p class="status"><img src="{{asset('images/chech.svg')}}" alt="">Активная</p>
                <span>Создан 15 мая 2020г, 14:00</span>
            </div>
            <div class="savemailing__wrapper__content">
                <div style="width: 100%;" class="savemailing__wrapper__content__item">
                <div class="savemailing__wrapper__content__item__text">
                        <p>Сайт:</p>
                        <span>puzzlepro.ru<p>(0 подписчиков)</p></span>
                    </div>
                    <div class="savemailing__wrapper__content__item__text">
                        <p>URL RSS ленты:</p>
                        <span>https://lenta.ru/rss</span>
                    </div>
                    <div class="savemailing__wrapper__content__item__text">
                        <p>Категории</p>
                        <p>Все</p>
                    </div>
                    <div class="savemailing__wrapper__content__item__text">
                        <p>Отправлять не более:</p>
                        <div>
                        <span class="sf">5</span>
                            <p>раз в сутки</p>
                        </div>
                    </div>
                </div>
                <div class="savemailing__wrapper__content__item">
                    <div class="right__block">
                        <div class="right__block__wrapper">
                            <a class="close"><img src="{{asset('images/close.svg')}}" alt=""></a>
                            <a class="setting"><img src="{{asset('images/setting.svg')}}" alt=""></a>
                            <div class="right__block__wrap__wrap">
                                <img src="{{asset('images/avatar.png')}}" alt="">
                                <div class="right__block__wrapper__text">
                                    <p>Текст вашего сообщения</p>
                                    <span>puzzlepro.ru</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button_green mr-24">
            <span class="green_button_circle"></span>
            <a class="button_green_inner">
                <p class="button_text_container">
                    <img src="{{asset('images/send.svg')}}" alt="">Создать автоматическую рассылку
                </p>
            </a>
        </div>
    </div>
</main>

@endsection