@extends('layouts.app')
@section('title', __('Редактирование авторассылки'))
@section('content')
<main class="main createmailing">
    <div class="container">
        <form action="{{ route('autoMailing.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="general__title">
                <div class="title">
                    Новая авторассылка
                </div>
            </div>
            <div class="createmailing__wrapper">
                <div class="createmailing__wrapper__item">
                    <label><span>Название рассылки:</span> <input type="text" name="name" placeholder="Введите название рассылки"></label>
                </div>
                <div class="createmailing__wrapper__item">
                    <label>
                        <span>Условие отправки:</span>
                        <div class="createmailing-select">
                            <div class="createmailing-select__current" data-name="shipping_conditions">
                                <input type="hidden" name="shipping_conditions" class="hidden_input_for_data" value="">
                                <p class="set-select">Подписка на рассылку</p><img src="{{asset('images/down.svg')}}" alt="">
                            </div>
                            <div class="createmailing-select__menus">
                                <span class="select-item" data-type="createmailing-select-conditions" data-id="1">Подписка на рассылку</span>
                                <span class="select-item" data-type="createmailing-select-conditions" data-id="2">Подписка на рассылку1</span>
                                <span class="select-item" data-type="createmailing-select-conditions" data-id="3">Подписка на рассылку2</span>
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
                            <div><input type="checkbox" name="days[]" value="monday"><br><span>Пн</span></div>
                            <div><input type="checkbox" name="days[]" value="tuesday"><br><span>Вт</span></div>
                            <div><input type="checkbox" name="days[]" value="wednesday"><br><span>Ср</span></div>
                            <div><input type="checkbox" name="days[]" value="thursday"><br><span>Чт</span></div>
                            <div><input type="checkbox" name="days[]" value="friday"><br><span>Пт</span></div>
                            <div><input type="checkbox" name="days[]" value="saturday"><br><span>Сб</span></div>
                            <div><input type="checkbox" name="days[]" value="sunday"><br><span>Вс</span></div>
                        </div>
                    </div>
                </div>
                <div class="createmailing__wrapper__item">
                    <div class="createmailing__wrapper__item__checkbox">
                        <label>
                            <span>Вреия отправки:</span>
                        </label>
                        <div class="createmailing__wrapper__item__input trl">
                            <input class="time" min="0" name="hour" value="00" max="23" type="number" placeholder="00">
                            <span>:</span>
                            <input class="time" min="0" value="00" name="minute" max="59" type="number" placeholder="00">
                        </div>
                    </div>
                </div>
                <div class="createmailing__wrapper__item">
                    <label>
                        <span>Название отправки:</span>
                        <div class="createmailing-select">
                            <div class="createmailing-select__current" data-name="sites" data-selectMode="multiple">
                                <input type="hidden" class="hidden_input_for_data" value="">
                                <p class="set-select" data-textType="default">Выбрать</p><img src="{{asset('images/down.svg')}}" alt="">
                            </div>
                            <div class="createmailing-select__menus">
                                @foreach($sites as $site)
                                    <span class="select-item" data-isSelected="0" data-id="{{$site->id}}">
                                        {{$site->link}}
                                        ( {{$site->push_subscriptions_count}} подписчика )
                                    </span>
                                @endforeach
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
                        <label><span>Источник компании (utm_source)</span> <input type="text" name="utm_source" placeholder="pushgun"></label>
                        <label><span>Канал компании (utm_medium)</span> <input type="text" name="utm_medium" placeholder="webpush"></label>
                        <label><span>Название компании (utm_compaign)</span> <input type="text" name="utm_compaign" placeholder="compaign_id"></label>
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
                            <!-- <div class="createmailing-select__menus">
                                <p class="select-item">после</p>
                                <p class="select-item">через</p>
                            </div> -->
                        </div>
                        <div class="createmailing__wrapper__item">
                            <div class="createmailing__wrapper__item__checkbox">
                                <div class="createmailing__wrapper__item__input trl">
                                    <input class="min" name="delayNotify" min="0" max="23" value="0" type="number" placeholder="0">
                                    <input class="min" value="минут" type="text" placeholder="минут" readonly>
                                </div>
                            </div>
                            <!-- <span>в</span>
                            <div class="createmailing__wrapper__item__checkbox">
                                <div class="createmailing__wrapper__item__input trl">
                                    <input class="time" min="0" max="23" type="number" placeholder="00">
                                    <span>:</span>
                                    <input class="time" min="0" max="59" type="number" placeholder="00">
                                </div>
                            </div> -->
                            <span>после подписки</span>
                        </div>
                    </div>
                    <div class="createmailing__wrapper__two__content">
                        <div class="createmailing__wrapper__item">
                            <label><span class="ttl">Заголовок</span> <input type="text" name="title" placeholder="до 50 символов"></label>
                            <label><span class="ttl">Текст уведомления</span> <textarea type="text" name="text"></textarea></label>
                            <label>
                                <span class="ttl">Ссылка на уведомление</span>
                                <input type="text" name="link" value="">
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
                                        <input type="file" name="image">
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
                    <button type="submit" class="button_green_inner">
                        <p class="button_text_container">
                            Сохранить
                        </p>
                    </button>
                </div>
                <a class="button-create">Сохранить и запустить</a>
            </div>
        </form>
    </div>
</main>

@endsection