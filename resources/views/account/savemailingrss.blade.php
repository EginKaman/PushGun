@extends('layouts.app')
@section('title', __('RSS Редактирование авторассылки'))
@section('content')
<main class="main createmailing rss">
    <div class="container">
        <div class="general__title">
            <div class="title">
                Рассылка на основе RSS
            </div>
        </div>
        <div class="rss__block__wrapper">
            <div class="createmailing__wrapper">
                <div class="createmailing__wrapper__title">
                    <p>Адрес</p>
                    <div class="createmailing__wrapper__title__wrapper">
                        <span>https://lenta.ru/rss</span>
                        <p>Редактировать URL <img src="{{asset('images/pan.svg')}}" alt=""></p>
                    </div>
                </div>
                <div class="createmailing__wrapper__center">
                    <div class="createmailing__wrapper__item">
                    </div>
                    <div class="createmailing__wrapper__item">
                        <label><span>Название авторассылки</span> <input type="text" placeholder="Введите название"></label>
                        <label>
                            <span>Название отправки:</span>
                            <div class="createmailing-select">
                                <div class="createmailing-select__current">
                                    <p class="set-select">https://puzzle.pro.ru (2 подписчика)</p><img src="{{asset('images/down.svg')}}" alt="">
                                </div>
                                <div class="createmailing-select__menus">
                                    <span class="select-item">https://krutiepacani.pro.ru (2 подписчика)</span>
                                    <span class="select-item">https://kaif.pro.ru (6 подписчика)</span>
                                    <span class="select-item">https://puzzle.pro.ru (2 подписчика)</span>
                                </div>
                            </div>
                        </label>
                        <label><span>Заголовок</span> <input type="text" placeholder="до 50 символов"></label>
                        <label class="prelabel"><span class="ttl">Текст уведомления</span> <textarea type="text"></textarea></label>
                        <label>
                            <span>URL картинки сайта</span>
                            <div class="createmailing-select">
                                <div class="createmailing-select__current">
                                    <p class="set-select">https://puzzle.pro.ru (2 подписчика)</p><img src="{{asset('images/down.svg')}}" alt="">
                                </div>
                                <div class="createmailing-select__menus">
                                    <span class="select-item">https://krutiepacani.pro.ru (2 подписчика)</span>
                                    <span class="select-item">https://kaif.pro.ru (6 подписчика)</span>
                                    <span class="select-item">https://puzzle.pro.ru (2 подписчика)</span>
                                </div>
                            </div>
                        </label>
                        <div class="createmailing__wrapper__item">
                            <div class="rss-reset">
                                <div class="rss-reset-item">
                                    <a>Отправлять не более:</a>
                                    <div class="createmailing__wrapper__item__checkbox">
                                        <div class="createmailing__wrapper__item__input trl">
                                            <input class="time" min="0" max="59" type="number" placeholder="00">
                                        </div>
                                        <span>Рассылок в сутки</span>
                                    </div>
                                </div>
                                <div class="rss-reset-item">
                                    <label>
                                        <span>Темы:</span>
                                        <div class="createmailing-select">
                                            <div class="createmailing-select__current">
                                                <p class="set-select">Все</p><img src="{{asset('images/down.svg')}}" alt="">
                                            </div>
                                            <div class="createmailing-select__menus">
                                                <span class="select-item">Розовая</span>
                                                <span class="select-item">Коричневая</span>
                                                <span class="select-item">Черная</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <label>
                                <span>Ссылка на увдеомление:</span>
                                <div class="createmailing-select">
                                    <div class="createmailing-select__current">
                                        <p class="set-select">https://puzzle.pro.ru</p><img src="{{asset('images/down.svg')}}" alt="">
                                    </div>
                                    <div class="createmailing-select__menus">
                                        <span class="select-item">https://krutiepacani.pro.ru</span>
                                        <span class="select-item">https://kaif.pro.ru</span>
                                        <span class="select-item">https://puzzle.pro.ru</span>
                                    </div>
                                </div>
                            </label>
                            <div class="createmailing__wrapper__item__checkbox">
                                <div style="max-width: 100%;" class="createmailing__wrapper__item__input">
                                    <div><input type="checkbox"><br><span style="color: #000;">UTM-метки</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="savemailing__wrapper__content__item">
                <div class="right__block">
                    <a class="close"><img src="{{asset('images/lapa.svg')}}" alt=""></a>
                    <a class="setting"><img src="{{asset('images/lapa.svg')}}" alt=""></a>
                    <div class="right__block__wrapper">
                        <p class="til">Chrom, Windows</p>
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
        <div style="background: none; border: none;box-shadow:none;" class="createmailing-foot">
            <div class="button_green mr-24">
                <span class="green_button_circle"></span>
                <a href="{{ route('account.createmailingrss') }}" class="button_green_inner">
                    <p class="button_text_container">
                        Сохранить
                    </p>
                </a>
            </div>
            <a class="button-create">Сохранить и запустить</a>
        </div>
    </div>
</main>

@endsection