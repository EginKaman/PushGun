@extends('layouts.app')
@section('content')
    <main class="main setgen">
        <div class="container">
            <div class="general__title">
                <h1 class="title">Настройки сайта</h1>
                <div class="button_rb mail__button setgen__button">
                        <span class="rb_button_circle">
                        </span>
                    <button class="button_rb_inner mail__button_inner setgen__button_inner">
                        <p class="rb_button_text_container">
                            {{ $site->link }} →
                        </p>
                    </button>
                </div>
            </div>
            <section id="general-sec" class="choosen">
                <div class="setgen__buttons">
                    <div class="sett-btn setgen__buttons_active">
                        <div class="">Общие настройки</div>
                    </div>
                    <div id="integration" class="sett-btn setgen__buttons_link">
                        <div class="new-tab">Интеграция с сайтом</div>
                    </div>
                    <div id="request" class="sett-btn setgen__buttons_link">
                        <div class="new-tab">Запрос подписки</div>
                    </div>
                </div>
                <div class="setgen__info">
                    <dl class="setgen__info_block">
                        <dt class="setgen__info_title">URL сайта:</dt>
                        <dd class="setgen__info_desc">{{ $site->url }}
                            <img class="checked" src="{{ asset('images/mark.svg') }}" alt="">
                        </dd>
                    </dl>
                    <dl class="setgen__info_block">
                        <dt class="setgen__info_title">Изображение сайта:</dt>
                        <dd class="setgen__info_upload">

                            <form action="{{ route('site.update') }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="file" name="image" id="siteAvatar" required>
                                <label for="siteAvatar" class="setgen__form">
                                    <img src="{{ asset('images/site.svg') }}" alt="">
                                    <div class="setgen__form_block">
                                        <p class="setgen__form_title">Выбрать изображение</p>
                                        <p class="setgen__form_desc">Рекомендуемый размер: 128×128px
                                            JPG, svg до 200KB</p>
                                    </div>
                                </label>
                                <div class="setgen__info_block">
                                    <div class="setgen__info_desc">
                                        <input type="checkbox" class="checkbox-input" name="getPush" id="getPush">
                                        <label class="label-checkbox" for="getPush">
                                            Отправлять приветственное push-уведомление после подписки
                                        </label>
                                    </div>
                                </div>
                                <div class="setgen__down-buttons">
                                    <div class="button_green save__button">
                                        <span class="green_button_circle"></span>
                                        <button type="submit" class="button_green_inner">
                                            <p class="button_text_container">
                                                Сохранить
                                            </p>
                                        </button>
                                    </div>
                                    <button class="setgen__delete">Удалить веб-сайт</button>
                                </div>
                            </form>
                        </dd>
                    </dl>
                </div>
            </section>
            <section id="integration-sec" class="setgen setint">
                <div class="setgen__buttons setint__buttons">
                    <div id="general" class="sett-btn setgen__buttons_link">
                        <div class="new-tab">Общие настройки</div>
                    </div>
                    <div class="sett-btn setgen__buttons_active">
                        <div class="">Интеграция с сайтом</div>
                    </div>
                    <div id="request" class="sett-btn setgen__buttons_link">
                        <div class="new-tab">Запрос подписки</div>
                    </div>
                </div>
                <h3 class="setint__desc">Код PUSH.GUN для сайта</h3>
                <div class="setint__info">
                    <p class="setint__info_title">Скопируйте и вставьте код на ваш сайт, перед закрывающим тегом
                        <span>&lt;/head&gt;</span></p>
                    <pre><code>&lt;script charset="UTF-8" src="{{ config('app.url') }}/storage/push/{{ $site->script }}" async&gt;&lt;/script&gt;</code></pre>
                    <div class="setint__info_checked">
                        <img src="{{ asset('images/mark.svg') }}" width="16" height="16" alt="V">
                        <p style="color: #3B8378">Код добавлен корректно</p>
                    </div>

                </div>
                <h3 class="setint__desc">Установочные файлы Chrome</h3>
                <div class="setint__info">
                    <p class="setint__info_title">Для поддержки Chrome, загрузите установочные файлы ниже. Распакуйте из
                        архива и скопируйте файлы в каталог верхнего уровня (root , или '/') вашего сайта.</p>
                    <div class="setint__info_download">
                        <img src="{{ asset('images/download.svg') }}" width="16" height="16" alt="">
                        <a target="_blank" href="{{ route('download.index', $site) }}">
                            @lang('Скачать установочные файлы')
                        </a>
                    </div>
                    <div class="setint__info_checked">
                        <img src="{{ asset('images/removeRed.svg') }}" width="16" height="16" alt="X">
                        <p style="color: #F33657">Файлы sp-push-worker-fb.js, sp-push-manifest.json не установлены</p>
                    </div>

                </div>
                <div class="button_green save__button setint__button">
                    <span class="green_button_circle"></span>
                    <button class="button_green_inner">
                        <p class="button_text_container">
                            <img src="{{ asset('images/reload.svg') }}" alt="">Перепроверить
                        </p>
                    </button>
                </div>
            </section>
            <section id="request-sec" class="setreq">
                <div class="setgen__buttons">
                    <div id="general" class="sett-btn setgen__buttons_link">
                        <div class="new-tab">Общие настройки</div>
                    </div>
                    <div id="integration" class="sett-btn setgen__buttons_link">
                        <div class="new-tab">Интеграция с сайтом</div>
                    </div>
                    <div class="sett-btn setgen__buttons_active">
                        <div class="">Запрос подписки</div>
                    </div>
                </div>
                <div class="setgen__info">
                    <dt class="setgen__info_title">Запрос на подписку:</dt>
                    <form action="" method="post">
                        <div class="setgen__info_block">
                            <div class="setgen__info_desc setreq__info_block">
                                <div class="setreq__radio">
                                    <input type="radio" name="requestOn" id="onJoin" value="onJoin" checked>
                                    <label for="onJoin" class="label-checkbox">При заходе на сайт</label>
                                    <img class="setreq__info" src="{{ asset('images/info.svg') }}" alt="">
                                </div>
                                <div class="setreq__radio">
                                    <input type="radio" name="requestOn" id="onClick" value="onClick">
                                    <label for="onClick" class="label-checkbox">При клике на элемент</label>
                                    <img class="setreq__info" src="{{ asset('images/info.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="setgen__info_desc">
                                <div class="setreq__checkbox">
                                    <input type="checkbox" class="checkbox-input" name="addTip" id="addTip">
                                    <label class="label-checkbox" for="addTip">Добавить текст-подсказку</label>
                                </div>
                                <p class="setreq__sample">Пример подсказки</p>

                            </div>
                            <div class="setgen__info_desc">
                                <div class="setreq__checkbox">
                                    <input type="checkbox" class="checkbox-input" name="hideMobile" id="hideMobile">
                                    <label class="label-checkbox" for="hideMobile">
                                        Скрывать на мобильных устройствах
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setgen__down-buttons">
                            <div class="button_green save__button">
                                <span class="green_button_circle"></span>
                                <button type="submit" class="button_green_inner">
                                    <p class="button_text_container">
                                        Сохранить
                                    </p>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection
