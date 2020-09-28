@extends('layouts.app')
@section('title', __('Отправить push-уведомление'))
@section('content')
    <main>
        <section class="push">
            <div class="container">
                <div class="push__title">
                    <h1>@lang('Отправить push-уведомление')</h1>
                </div>
                <div class="inner">

                    <div class="push__settings">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('push.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="push__input">
                                <label>@lang('Список получателей')</label>
                                <select id="site" class="filter__input filter__selector" name="site" type="text">
                                    @foreach($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->link }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="push__input">
                                <label for="pushSelect">@lang('Заголовок')</label>
                                <input class="inputTitle" maxlength="30" name="title" type="text"
                                       placeholder="@lang('до 30 символов')">
                            </div>
                            <div class="push__input">
                                <label for="pushSelect">@lang('Текст уведомления')</label>
                                <textarea class="textarea" name="text" maxlength="130" cols="5" rows="5"></textarea>
                            </div>
                            <div class="push__input">
                                <label for="pushSelect">@lang('Ссылка на уведомление')</label>
                                <input type="text" name="link" placeholder="https://example.com">
                            </div>
                            <div class="agree">
                                <input type="checkbox" name="changeIcon" id="changeIcon">
                                <label for="changeIcon">@lang('Заменить стандартную картинку сайта')</label>

                                <div class="site_set_avatar" id="site_set_avatar">
                                    <input type="file" name="image" id="siteAvatar" accept="image/*">
                                    <div class="site_set_avatar_title">@lang('Картинка уведомления')</div>
                                    <label for="siteAvatar" class="site_avatar_form">
                                        <img src="{{ asset('images/site.svg') }}" alt="" id="image">
                                        <div class="site_avatar_form_block">
                                            <p class="site_avatar_form_desc">@lang('Рекомендуемый размер: 128×128px JPG, svg до 200KB')</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="bottom">
                                <div class="bottom_inner">
                                    <div class="button_green mr-24">
                                    <span class="green_button_circle">
                                    </span>
                                        <button type="submit" class="button_green_inner">
                                            <p class="button_text_container">@lang('Отправить')</p>
                                        </button>
                                    </div>
                                    <!-- <div class="buttons">
                                        <button class="clock"></button>
                                        <button class="settings"></button>
                                    </div> -->
                                </div>
                                <div class="send__push">
                                    <a href="#">@lang('Отправить тестовый push')</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div style="background-image: url({{ asset('images/send-bg.jpg') }})" class="push__test">
                        <div class="block">
                            <p>Chrome, Windows</p>
                            <div class="chrome">
                                <img src="{{ asset('images/avatar.svg') }}" alt="avatar">
                                <div class="chrome__text">
                                    <p class="res">Google Chrome • puzzlepro.ru</p>
                                    <a class="txt" href="#">@lang('Текст вашего сообщения')</a>
                                </div>
                            </div>
                            <div class="block">
                                <p>Firefox, Windows</p>
                                <div class="firefox">
                                    <img src="{{ asset('images/avatar.svg') }}" alt="avatar">
                                    <div class="firefox__text">
                                        <p class="res">puzzlepro.ru</p>
                                        <a class="txt" href="#">@lang('Текст вашего сообщения')</a>
                                    </div>
                                </div>
                            </div>
                            <div class="block">
                                <p>Chrome, macOS</p>
                                <div class="macos">
                                    <img class="macos__avatar" src="{{ asset('images/chrome.svg') }}" alt="chrome">
                                    <div class="macos__text">
                                        <a class="res" href="#">puzzlepro.ru</a>
                                        <p class="txt">@lang('Текст вашего сообщения')</p>
                                    </div>
                                    <img class="macos__avatar" src="{{ asset('images/avatar.svg') }}" alt="avatar">
                                    <div class="macos__settings">
                                        <span>@lang('Закрыть')</span>
                                        <span>@lang('Настройки')</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
