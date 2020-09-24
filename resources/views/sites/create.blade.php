@extends('layouts.app')
@section('title',__('Добавить новый сайт'))
@section('content')
    <main class="main">
        <div class="container">
            <section class="add-site">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('site.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <article class="step-1">
                        <div class="general__title">
                            <h1 class="title">@lang('Добавить новый сайт')</h1>
                        </div>

                        <div class="site_domain">
                            <select name="protocol" id="" class="site_domain_select" required>
                                <option value="https">HTTPS://</option>
                                <option value="http">HTTP://</option>
                            </select>
                            <input type="text" name="domain" class="site_domain_name" value="{{ old('domain') }}"
                                   required
                                   placeholder="example.com">
                        </div>

                        <div class="small__title sec">
                            <h3 class="small-title">@lang('Общие настройки сайта')</h3>
                        </div>

                        <div class="site_set">
                            <div class="site_set_avatar">
                                <input type="file" name="image" id="image" required>
                                <div class="site_set_avatar_title">@lang('Картинка сайта')</div>
                                <label for="image" class="site_avatar_form">
                                    <img src="{{ asset('images/site.svg') }}" alt="">
                                    <div class="site_avatar_form_block">
                                        <p class="site_avatar_form_title">@lang('Выберите изображение')</p>
                                        <p class="site_avatar_form_desc">
                                            @lang('Рекомендуемый размер: 128×128px JPG, svg до 200KB')
                                        </p>
                                    </div>
                                </label>
                            </div>

                            <div class="site_set_sub">
                                <div class="site_set_sub_title">@lang('Запрос на подписку')</div>
                                <div class="site_set_sub_radio">
                                    <div class="setreq__radio">
                                        <input type="radio" name="request" id="onJoin" value="visit" checked="">
                                        <label for="onJoin" class="label-checkbox">@lang('При заходе на сайт')</label>
                                        <img class="setreq__info" src="{{ asset('images/info.svg') }}" alt="">
                                    </div>
                                    <div class="setreq__radio">
                                        <input type="radio" name="request" id="onClick" value="click">
                                        <label for="onClick" class="label-checkbox">@lang('При клике на элемент')</label>
                                        <img class="setreq__info" src="{{ asset('images/info.svg') }}" alt="">
                                    </div>
                                    <div class="setreq__radio">
                                        <input type="radio" name="request" id="intermediate" value="intermediate">
                                        <label for="intermediate" class="label-checkbox">
                                            @lang('С промежуточным запросом')
                                        </label>
                                    </div>
                                </div>

                                <div class="site_set_sub_checkbox">
                                    <div class="setreq__checkbox">
                                        <input type="checkbox" class="checkbox-input" name="addTip" id="addTip">
                                        <label class="label-checkbox" for="addTip">@lang('Добавить текст-подсказку')</label>
                                    </div>
                                    <p class="setreq__sample">@lang('Пример подсказки')</p>
                                </div>
                            </div>

                            <div class="site_set_push">
                                <div class="site_set_push_title">@lang('Условия показа запроса')</div>
                                <div class="site_set_push_labels">
                                    <div class="site_set_push_label">
                                        <h6>@lang('Показ запроса при')</h6>
                                        <div class="site_set_push_label_input">
                                            <input type="number" value="1">
                                            <span>@lang('визите')</span>
                                        </div>
                                    </div>

                                    <div class="site_set_push_label">
                                        <h6>@lang('Задержка появления')</h6>
                                        <div class="site_set_push_label_input">
                                            <input type="number" name="delay" value="{{ old('delay', 1) }}">
                                            <span>@lang('сек')</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="site_set_push_info">
                                    @lang('Хорошая практика - предлагать подписаться на web push только при повторном визите')
                                </div>
                            </div>

                            <div class="site_set_hide">
                                <div class="site_set_sub_checkbox">
                                    <div class="setreq__checkbox">
                                        <input type="checkbox" class="checkbox-input" name="mobile" id="hideMobile">
                                        <label class="label-checkbox" for="hideMobile">
                                            @lang('Скрывать на мобильных девайсах')
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="button_green_inner">
                            <p class="button_text_container">@lang('Следующий шаг')</p>
                        </button>
                    </article>
                </form>
            </section>
        </div>
    </main>
@endsection
