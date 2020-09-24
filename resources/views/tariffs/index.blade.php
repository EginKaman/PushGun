@extends('layouts.app')
@section('title', __('Тарифы'))
@section('content')
    <main class="main single-mail">
        <div class="container">
            <section class="tariffs">
                <div class="general__title">
                    <h1 class="title">Тарифы</h1>
                </div>
                <div class="mail__time-sent">
                    <p>Текущий план: {{ $tariff->name }}</p>
                </div>

                <div class="tariff-wrap">

                    <div class="tariff tariff-fs">
                        <div class="tariff-text">
                            <h3 class="tariff-title">Базовый</h3>
                            <strong class="tariff-subtitle">до 1 000 подписчиков</strong>
                            <ul class="tariff-offer">
                                <li>Неограниченное количество web push сообщений</li>
                                <li>Поддержка HTTP и HTTPS</li>
                                <li>Рассылка RSS</li>
                                <li>Персонализация сообщений</li>
                            </ul>
                        </div>
                        <div class="tariff-bottom">
                            <span class="tariff-price">Бесплатно </span>

                            <div class="button_green tariff-bay">
                                <span class="green_button_circle">
                                </span>
                                <button type="submit" class="button_green_inner">
                                    <p class="rb_button_text_container">
                                        Активировать
                                    </p>
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="tariff tariff-sec">
                        <form action="#" class="tariff-form">
                            <div class="tarim-top">
                                <h3 class="tariff-title">PRO</h3>
                                <strong class="tariff-subtitle number-followers">от 30 000 подписчиков</strong>
                                <div class="tariff-slider"></div>
                                <div class="tariff-slider-val">
                                    <!-- <div class="tariff-slider__line"></div> -->
                                    <div class="tariff-slider__item active" data-price="3900">
                                        <span class="tariff-slider__point fs"></span>
                                        <span class="tariff-slider__text">30к</span>
                                    </div>
                                    <div class="tariff-slider__item" data-price="6000">
                                        <span class="tariff-slider__point sec"></span>
                                        <span class="tariff-slider__text">60к</span>
                                    </div>
                                    <div class="tariff-slider__item" data-price="10000">
                                        <span class="tariff-slider__point th"></span>
                                        <span class="tariff-slider__text">200к</span>
                                    </div>
                                    <div class="tariff-slider__item" data-price="13400">
                                        <span class="tariff-slider__point fr"></span>
                                        <span class="tariff-slider__text">∞</span>
                                    </div>
                                </div>
                                <ul class="tariff-offer">
                                    <li>Отсутствие ссылки «Работает с помощью Push.Gun» в окне запроса подписки</li>
                                    <li>Приоритетная поддержка</li>
                                </ul>
                                <label for="sale" class="tariff-check">
                                    <input type="checkbox" name="sale" id="sale">
                                    <span class="check"></span>
                                    <span class="tariff-check__text">Подписка на год - 20%</span>
                                </label>
                            </div>

                            <div class="tariff-bottom">
                                <span class="tariff-price"><span id="tariff-price"> 3900</span> руб./мес. </span>
                                <input type="hidden" name="" class="followsCount" value="30к">

                                <div class="button_rb tariff-bay">
                                    <span class="rb_button_circle">
                                    </span>
                                    <button type="submit" class="button_rb_inner">
                                        <p class="rb_button_text_container">
                                            Купить
                                        </p>
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>

                </div>


                <div class="general__title sec">
                    <h2 class="title">Мои подписки</h2>
                </div>


                <div class="follows-wrap">
                    <div class="follows-row">
                        <div class="follows-left">
                            <span class="follows-text">Ваш текущий баланс:</span>
                        </div>
                        <div class="follows-right">
                            <span class="follows-text">{{ $user->balance }} руб</span>
                        </div>
                    </div>
                    <div class="follows-row">
                        <div class="follows-left">
                            <span class="follows-text">Ближайшая следующая оплата:</span>
                        </div>
                        <div class="follows-right">
                            <span class="follows-text">29 ноября 2020 г. 09:20</span>
                        </div>
                    </div>
                    <div class="follows-row">
                        <div class="follows-left">
                            <span class="follows-text">Последнее снятие баланса:</span>
                        </div>
                        <div class="follows-right">
                            <span class="follows-text">29 ноября 2020 г. 16:20</span>
                        </div>
                    </div>
                </div>


                <div class="follows-wrap">
                    <div class="follows-top">
                        <div class="follows-title">
                            <span class="follows-title__hero">
                                Тарифный план: <b>{{ $tariff->name }}</b>
                            </span>
                            <span class="follows-title__subtitle">
                                Количество подписчиков: {{ $tariff->max_followers }}
                            </span>
                        </div>
                        <a href="" class="follows-change__tariff">Выбрать другой тарифный план</a>
                    </div>
                    <div class="follows-row bb-1">
                        <div class="follows-left">
                            <span class="follows-text">Статус:</span>
                        </div>
                        <div class="follows-right">
                            <span class="follows-text green">Активен</span>
                        </div>
                    </div>
                    <div class="follows-row bb-1">
                        <div class="follows-left">
                            <span class="follows-text">Активен до:</span>
                        </div>
                        <div class="follows-right">
                            <span class="follows-text">29 ноября 2020 г. 09:20</span>
                        </div>
                    </div>
                    <div class="follows-row bb-1">
                        <div class="follows-left">
                            <span class="follows-text">Пакет активирован:</span>
                        </div>
                        <div class="follows-right">
                            <span class="follows-text">29 апреля 2020 г. 16:20</span>
                        </div>
                    </div>
                    <div class="follows-row bb-1">
                        <div class="follows-left">
                            <span class="follows-text">Размер платежа:</span>
                        </div>
                        <div class="follows-right">
                            <span class="follows-text">{{ $tariff->price }} руб</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
