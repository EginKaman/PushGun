@extends('layouts.app')
@section('title', __('Создание авторассылки'))
@section('content')
<main class="main createmailing">
    <div class="container">
        <div class="general__title">
            <div class="title">
                Новая авторассылка
            </div>
        </div>
        <div class="createmailing__wrapper">
            <div class="createmailing__wrapper__item">
                <label><span>Название рассылки:</span> <input type="text" placeholder="Введите название рассылки"></label>
            </div>
            <div class="createmailing__wrapper__item">
                <label>
                    <span>Условие отправки:</span>
                    <div class="createmailing-select">
                        <div class="createmailing-select__current">
                            <p class="set-select">Подписка на рассылку</p><img src="{{asset('images/down.svg')}}" alt="">
                        </div>
                        <div class="createmailing-select__menus">
                            <span class="select-item">Подписка на рассылку</span>
                            <span class="select-item">Подписка на рассылку1</span>
                            <span class="select-item">Подписка на рассылку2</span>
                        </div>
                    </div>
                </label>
            </div>
            <div class="createmailing__wrapper__item">
                <div class="createmailing__wrapper__item__checkbox">
                    <label class="trc">
                        <span>Дни отправки:</span>
                    </label>
                    <div class="createmailing__wrapper__item__input">
                        <div><input type="checkbox"><br><span>Пн</span></div>
                        <div><input type="checkbox"><br><span>Вт</span></div>
                        <div><input type="checkbox"><br><span>Ср</span></div>
                        <div><input type="checkbox"><br><span>Чт</span></div>
                        <div><input type="checkbox"><br><span>Пт</span></div>
                        <div><input type="checkbox"><br><span>Сб</span></div>
                        <div><input type="checkbox"><br><span>Вс</span></div>
                    </div>
                </div>
            </div>
            <div class="createmailing__wrapper__item">
                <div class="createmailing__wrapper__item__checkbox">
                    <label>
                        <span>Вреия отправки:</span>
                    </label>
                    <div class="createmailing__wrapper__item__input trl">
                        <input class="time" min="0" max="23" type="number" placeholder="00">
                        <span>:</span>
                        <input class="time" min="0" max="59" type="number" placeholder="00">
                    </div>
                </div>
            </div>
            <div class="createmailing__wrapper__item">
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
            </div>
            <div class="createmailing__wrapper__center">
                <div class="createmailing__wrapper__item__checkbox">
                    <div class="createmailing__wrapper__item__input">
                        <div><input type="checkbox"><br><span>Добавить метки для Google Analytics и Яндекс метрики</span></div>
                    </div>
                </div>
                <div class="createmailing__wrapper__item">
                </div>
                <div class="createmailing__wrapper__item">
                    <label><span>Источник компании (utm_source)</span> <input type="text" placeholder="pushgun"></label>
                    <label><span>Канал компании (urm_medium)</span> <input type="text" placeholder="webpush"></label>
                    <label><span>Название компании (utm_compaign)</span> <input type="text" placeholder="compaign_id"></label>
                    <p>Используйте compaign_id для автоматической подстановки id push-рассылки</p>
                </div>
            </div>
        </div>
        <div class="contains">
            <div class="left__item__block">
                <div class="left__item__content">
                    <span class="oval">1</span>
                    <span class="polosa"></span>
                    <span class="oval">+</span>
                </div>
            </div>
            <div class="createmailing__wrapper__two">
                <div class="createmailing__wrapper__two__head">
                    <p>Отправить push</p>
                    <div class="createmailing-select">
                        <div class="createmailing-select__current">
                            <p class="set-select">через</p><img src="{{asset('images/down.svg')}}" alt="">
                        </div>
                        <div class="createmailing-select__menus">
                            <p class="select-item">после</p>
                            <p class="select-item">через</p>
                        </div>
                    </div>
                    <div class="createmailing__wrapper__item">
                        <div class="createmailing__wrapper__item__checkbox">
                            <div class="createmailing__wrapper__item__input trl">
                                <input class="min" min="0" max="23" type="number" placeholder="0">
                                <input class="min" value="минут" type="text" placeholder="минут">
                            </div>
                        </div>
                        <span>в</span>
                        <div class="createmailing__wrapper__item__checkbox">
                            <div class="createmailing__wrapper__item__input trl">
                                <input class="time" min="0" max="23" type="number" placeholder="00">
                                <span>:</span>
                                <input class="time" min="0" max="59" type="number" placeholder="00">
                            </div>
                        </div>
                        <span>после подписки</span>
                    </div>
                </div>
                <div class="createmailing__wrapper__two__content">
                    <div class="createmailing__wrapper__item">
                        <label><span class="ttl">Заголовок</span> <input type="text" placeholder="до 50 символов"></label>
                        <label><span class="ttl">Текст уведомления</span> <textarea type="text"></textarea></label>
                        <label>
                            <span class="ttl">Ссылка на уведомление</span>
                            <div class="createmailing-select">
                                <div class="createmailing-select__current">
                                    <p class="set-select">htpps://example.com</p><img src="{{asset('images/down.svg')}}" alt="">
                                </div>
                                <div class="createmailing-select__menus">
                                    <span class="select-item">htpps://example.com</span>
                                    <span class="select-item">htpps://example.com1</span>
                                    <span class="select-item">htpps://example.com2</span>
                                </div>
                            </div>
                        </label>
                        <div class="createmailing__wrapper__item__checkbox">
                            <div class="createmailing__wrapper__item__input">
                                <div><input type="checkbox"><br><span style="color: 000;">Заменить стандартную картинку сайта</span></div>
                            </div>
                        </div>
                        <label class="image__site">
                            <span class="ttl">Изображение сайта</span>
                            <div class="image__site__block">
                                <img src="{{asset('images/avatar.png')}}" alt="">
                                <label class="file">
                                    Выбрать изображение
                                    <input type="file">
                                    <span>Рекомендуемый размер: 128*128px <br>
                                        JPG, PNG до 200KB
                                    </span>
                                </label>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="save-block">
                <a class="button-create">Новое уведомление</a>
            </div>
        </div>
        <div class="createmailing-foot">
            <div class="button_green mr-24">
                <span class="green_button_circle"></span>
                <a class="button_green_inner">
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