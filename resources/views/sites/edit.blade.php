@extends('layouts.app')
@section('title', __('Настройки сайта'))
@section('content')
    <main class="main setgen">
        <div class="container">
            <div class="general__title">
                <h1 class="title">@lang('Настройки сайта')</h1>
                <div class="button_rb mail__button setgen__button">
                    <span class="rb_button_circle">
                    </span>
                    <a href="{{ route('site.show', $site) }}"
                       class="button_rb_inner mail__button_inner setgen__button_inner">
                        <p class="rb_button_text_container">
                            {{ $site->link }} →
                        </p>
                    </a>
                </div>
            </div>
            <form action="{{ route('site.update', $site) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <section id="general-sec" class="choosen">
                    <div class="setgen__buttons">
                        <div class="sett-btn setgen__buttons_active">
                            <div class="">@lang('Общие настройки')</div>
                        </div>
                        <div id="integration" class="sett-btn setgen__buttons_link">
                            <div class="new-tab">@lang('Интеграция с сайтом')</div>
                        </div>
                        {{--                        <div id="request" class="sett-btn setgen__buttons_link">--}}
                        {{--                            <div class="new-tab">@lang('Запрос подписки')</div>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="setgen__info">
                        <dl class="setgen__info_block">
                            <dt class="setgen__info_title">@lang('URL сайта'):</dt>
                            <dd class="setgen__info_desc">{{ $site->link }}
                                @if($site->installed)
                                    <img class="checked" src="{{ asset('images/mark.svg') }}" alt="">
                                @endif
                            </dd>
                        </dl>
                        <dl class="setgen__info_block">
                            <dt class="setgen__info_title">@lang('Изображение сайта'):</dt>
                            <dd class="setgen__info_upload">
                                <image-component
                                    @if($site->image)
                                    image="{{ asset(Storage::url($site->image)) }}"
                                    @endif
                                ></image-component>
                                {{--                                <div class="setgen__info_block">--}}
                                {{--                                    <div class="setgen__info_desc">--}}
                                {{--                                        <input type="checkbox" class="checkbox-input" name="getPush" id="getPush">--}}
                                {{--                                        <label class="label-checkbox" for="getPush">--}}
                                {{--                                            @lang('Отправлять приветственное push-уведомление после подписки')--}}
                                {{--                                        </label>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </dd>
                        </dl>
{{--                        <dl class="setget__info_block">--}}
{{--                            <dt class="setgen__info_title">@lang('Запрос на подписку'):</dt>--}}
{{--                            <dd class="setgen__info_desc">--}}
{{--                                <div class="setreq__radio">--}}
{{--                                    <input type="radio" name="request" id="onJoin" value="visit"--}}
{{--                                           @if($site->request === 'visit')checked @endif>--}}
{{--                                    <label for="onJoin" class="label-checkbox">@lang('При заходе на сайт')</label>--}}
{{--                                    <img class="setreq__info" src="{{ asset('images/info.svg') }}" alt="">--}}
{{--                                </div>--}}
                                {{--                                <div class="setreq__radio">--}}
                                {{--                                    <input type="radio" name="request" id="onClick" value="click"--}}
                                {{--                                           @if($site->request === 'click')checked @endif>--}}
                                {{--                                    <label for="onClick"--}}
                                {{--                                           class="label-checkbox">@lang('При клике на элемент')</label>--}}
                                {{--                                    <img class="setreq__info" src="{{ asset('images/info.svg') }}" alt="">--}}
                                {{--                                </div>--}}
                                {{--                                <div class="setreq__radio">--}}
                                {{--                                    <input type="radio" name="request" id="intermediate" value="intermediate"--}}
                                {{--                                           @if($site->request === 'intermediate')checked @endif>--}}
                                {{--                                    <label for="intermediate" class="label-checkbox">--}}
                                {{--                                        @lang('С промежуточным запросом')--}}
                                {{--                                    </label>--}}
                                {{--                                </div>--}}
                                {{--                            <div class="setgen__info_desc">--}}
                                {{--                                <div class="setreq__checkbox">--}}
                                {{--                                    <input type="checkbox" class="checkbox-input" name="hint"--}}
                                {{--                                           @if($site->hint)checked @endif--}}
                                {{--                                           id="addTip" value="1">--}}
                                {{--                                    <label class="label-checkbox"--}}
                                {{--                                           for="addTip">@lang('Добавить текст-подсказку')</label>--}}
                                {{--                                </div>--}}
                                {{--                                <p class="setreq__sample">@lang('Пример подсказки')</p>--}}

                                {{--                            </div>--}}
{{--                            </dd>--}}
{{--                        </dl>--}}
{{--                        <dl class="setgen__info_block">--}}
{{--                            <dt class="setgen__info_title"></dt>--}}
{{--                            <dd class="setgen__info_desc">--}}
{{--                                <div class="setreq__checkbox">--}}
{{--                                    <input type="checkbox" class="checkbox-input" name="mobile"--}}
{{--                                           @if($site->mobile)checked @endif id="hideMobile" value="1">--}}
{{--                                    <label class="label-checkbox" for="hideMobile">--}}
{{--                                        @lang('Скрывать на мобильных девайсах')--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </dd>--}}
{{--                        </dl>--}}
                        <div class="setgen__down-buttons">
                            <div class="button_green save__button">
                                <span class="green_button_circle"></span>
                                <button type="submit" class="button_green_inner">
                                    <p class="button_text_container">
                                        @lang('Сохранить')
                                    </p>
                                </button>
                            </div>
                            <site-button-delete
                                button-class="setgen__delete"
                                action="{{ route('site.destroy', $site) }}"></site-button-delete>
                        </div>
                    </div>

                </section>
                <section id="integration-sec" class="setgen setint">
                    <div class="setgen__buttons setint__buttons">
                        <div id="general" class="sett-btn setgen__buttons_link">
                            <div class="new-tab">@lang('Общие настройки')</div>
                        </div>
                        <div class="sett-btn setgen__buttons_active">
                            <div class="">@lang('Интеграция с сайтом')</div>
                        </div>
                        {{--                        <div id="request" class="sett-btn setgen__buttons_link">--}}
                        {{--                            <div class="new-tab">@lang('Запрос подписки')</div>--}}
                        {{--                        </div>--}}
                    </div>
                    <site-check script="{{ url("/storage/push/$site->script") }}"
                                archive="{{ url('/storage/pg-push.zip') }}"
                                action="{{ action('Api\CheckScriptController', $site) }}"
                                button="@lang('Перепроверить')"
                                :recheck="true"
                                :installed="{{ json_encode($site->installed) }}"></site-check>
                </section>
                {{--                <section id="request-sec" class="setreq">--}}
                {{--                    <div class="setgen__buttons">--}}
                {{--                        <div id="general" class="sett-btn setgen__buttons_link">--}}
                {{--                            <div class="new-tab">@lang('Общие настройки')</div>--}}
                {{--                        </div>--}}
                {{--                        <div id="integration" class="sett-btn setgen__buttons_link">--}}
                {{--                            <div class="new-tab">@lang('Интеграция с сайтом')</div>--}}
                {{--                        </div>--}}
                {{--                        <div class="sett-btn setgen__buttons_active">--}}
                {{--                            <div class="">@lang('Запрос подписки')</div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <div class="setgen__info">--}}
                {{--                        <dt class="setgen__info_title">@lang('Запрос на подписку'):</dt>--}}
                {{--                        <div class="setgen__info_block">--}}
                {{--                            <div class="setgen__info_desc setreq__info_block">--}}
                {{--                                <div class="setreq__radio">--}}
                {{--                                    <input type="radio" name="request" id="onJoin" value="visit"--}}
                {{--                                           @if($site->request === 'visit')checked @endif>--}}
                {{--                                    <label for="onJoin" class="label-checkbox">@lang('При заходе на сайт')</label>--}}
                {{--                                    <img class="setreq__info" src="{{ asset('images/info.svg') }}" alt="">--}}
                {{--                                </div>--}}
                {{--                                --}}{{--                                <div class="setreq__radio">--}}
                {{--                                --}}{{--                                    <input type="radio" name="request" id="onClick" value="click"--}}
                {{--                                --}}{{--                                           @if($site->request === 'click')checked @endif>--}}
                {{--                                --}}{{--                                    <label for="onClick"--}}
                {{--                                --}}{{--                                           class="label-checkbox">@lang('При клике на элемент')</label>--}}
                {{--                                --}}{{--                                    <img class="setreq__info" src="{{ asset('images/info.svg') }}" alt="">--}}
                {{--                                --}}{{--                                </div>--}}
                {{--                                --}}{{--                                <div class="setreq__radio">--}}
                {{--                                --}}{{--                                    <input type="radio" name="request" id="intermediate" value="intermediate"--}}
                {{--                                --}}{{--                                           @if($site->request === 'intermediate')checked @endif>--}}
                {{--                                --}}{{--                                    <label for="intermediate" class="label-checkbox">--}}
                {{--                                --}}{{--                                        @lang('С промежуточным запросом')--}}
                {{--                                --}}{{--                                    </label>--}}
                {{--                                --}}{{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            --}}{{--                            <div class="setgen__info_desc">--}}
                {{--                            --}}{{--                                <div class="setreq__checkbox">--}}
                {{--                            --}}{{--                                    <input type="checkbox" class="checkbox-input" name="hint"--}}
                {{--                            --}}{{--                                           @if($site->hint)checked @endif--}}
                {{--                            --}}{{--                                           id="addTip" value="1">--}}
                {{--                            --}}{{--                                    <label class="label-checkbox"--}}
                {{--                            --}}{{--                                           for="addTip">@lang('Добавить текст-подсказку')</label>--}}
                {{--                            --}}{{--                                </div>--}}
                {{--                            --}}{{--                                <p class="setreq__sample">@lang('Пример подсказки')</p>--}}

                {{--                            --}}{{--                            </div>--}}
                {{--                            <div class="setgen__info_desc">--}}
                {{--                                <div class="setreq__checkbox">--}}
                {{--                                    <input type="checkbox" class="checkbox-input" name="mobile"--}}
                {{--                                           @if($site->mobile)checked @endif id="hideMobile" value="1">--}}
                {{--                                    <label class="label-checkbox" for="hideMobile">--}}
                {{--                                        @lang('Скрывать на мобильных девайсах')--}}
                {{--                                    </label>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="setgen__down-buttons">--}}
                {{--                            <div class="button_green save__button">--}}
                {{--                                <span class="green_button_circle"></span>--}}
                {{--                                <button type="submit" class="button_green_inner">--}}
                {{--                                    <p class="button_text_container">--}}
                {{--                                        @lang('Сохранить')--}}
                {{--                                    </p>--}}
                {{--                                </button>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </section>--}}
            </form>
        </div>
    </main>
@endsection
