@extends('layouts.app')
@section('title', __('Новый сайт добавлен'))
@section('content')

    <div class="container">
        <section class="add-site">
            <article class="step-1">
                <div class="general__title">
                    <h1 class="title">@lang('Сайт добавлен')</h1>
                </div>

                <section id="integration-sec" class="setgen setint choosen">
                    <form action="{{ route('complete.store', $site) }}" method="POST">
                        @csrf
                        <div class="setgen__info_desc">
                            {{ $site->link }}
                            {{--                            <img class="checked" src="{{ asset('images/mark.svg') }}" alt="">--}}
                        </div>
                        <h3 class="setint__desc">@lang('Добавьте код для подписки на сайт')</h3>
                        <div class="setint__info">
                            <p class="setint__info_title">@lang('Скопируйте и вставьте код на ваш сайт, перед закрывающим тегом')
                                <span>&lt;/head&gt;</span></p>
                            <pre><code>&lt;script charset="UTF-8" src="{{ config('app.url') }}/storage/push/{{ $site->script }}" async&gt;&lt;/script&gt;</code></pre>
                        </div>
                        <h3 class="setint__desc">
                            @lang('Загрузите установочные файлы chrome на сервер в корневую директорию сайта')
                        </h3>
                        <div class="setint__info">
                            <p class="setint__info_title">
                                @lang('Для поддержки Chrome, загрузите установочные файлы ниже. Распакуйте из архива и скопируйте файлы в каталог верхнего уровня (root , или \'/\') вашего сайта.')
                            </p>
                            <div class="setint__info_download">
                                <img src="{{ asset('images/download.svg') }}" width="16" height="16" alt="">
                                <a target="_blank" href="{{ url('storage/pg-push.zip') }}">
                                    @lang('Скачать установочные файлы')
                                </a>
                            </div>
                        </div>
                        <div class="save__button setint__button">
                            <button type="submit" class="button_green_inner">
                                <p class="button_text_container">
                                    <img src="{{ asset('images/reload.svg') }}" alt="">@lang('Проверить настройки')
                                </p>
                            </button>
                            <a href="{{ route('site.edit', $site) }}" class="setreq__sample">
                                @lang('Перейти в настройки сайта')
                            </a>
                        </div>
                    </form>
                </section>
            </article>
        </section>
    </div>
@endsection
