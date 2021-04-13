@extends('layouts.app')
@section('title', __('Адресная книга'))
@section('content')
    <div class="main contact">
        <div class="container">
            <div class="general__title">
                <h1 class="title">@lang('Адресная книга')</h1>
            </div>
            <div class="filter__popup">
                <form action="{{ route('contact.index') }}">
                    <div class="filter__popup__inner">
                        <div class="filter__popup_block w-50">
                            <label class="filter__popup_label" for="firstDate-input">@lang('Начальная дата')</label>
                            <input id="firstDate-input" class="datepicker-here filter__input" name="start" type="text"
                                value="{{ request('start') }}">
                        </div>
                        <div class="filter__popup_block w-50">
                            <label class="filter__popup_label" for="lastDate-input">@lang('Конечная дата')</label>
                            <input id="lastDate-input" class="datepicker-here filter__input" name="end" type="text"
                                value="{{ request('end') }}">
                        </div>
                        <div class="filter__popup_block">
                            <label class="filter__popup_label" for="text-input">@lang('Название')</label>
                            <input id="text-input" class="filter__input" name="name" type="text"
                                value="{{ request('name') }}">
                        </div>
                        <div class="button_lb">
                            <span class="lb_button_circle">
                            </span>
                            <a href="{{ route('push.index') }}" class="button_lb_inner">
                                <p class="lb_button_text_container">
                                    @lang('Сброс')
                                </p>
                            </a>
                        </div>
                        <div id="btn_select" class="button_rb">
                            <span class="rb_button_circle">
                            </span>
                            <button class="button_rb_inner" type="submit">
                                <p class="rb_button_text_container">
                                    @lang('Выбрать')
                                </p>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="contact-head">
                <div style="background: none; box-shadow: none" class="mails__filter">
                    <div class="mails__reset">
                        <div class="mails__reset_inner">@lang('Сбросить фильтр')</div>
                    </div>
                    <div id="filter" class="button_green">
                        <span class="green_button_circle">
                        </span>
                        <div class="button_green_inner mails__filter_btn">
                            <p class="button_text_container">
                                @lang('Фильтр')
                            </p>
                        </div>
                    </div>
                    <div class="mails__date">
                        <p id="firstDate">@lang('Начальная дата'): <span id="first-date">123</span>
                            <img id="first-date-del" src="{{ asset('images/remove.svg') }}" alt="">
                        </p>
                        <p id="lastDate">@lang('Конечная дата'): <span id="last-date">123</span>
                            <img id="last-date-del" src="{{ asset('images/remove.svg') }}" alt="">
                        </p>

                    </div>
                </div>
                <form id="sortform" action="{{ route('contact.index') }}" method="GET" class="contact-head__sort">
                    <p>Сортировать по:</p>
                    <select name="sort" form="sortform" onchange="this.form.submit()">
                        <option value="date_decreasing">Дата создания(убывание)</option>
                        <option value="date_ascending">Дата создания (возрастание)</option>
                        <option value="quantity_decreasing">Количество контактов(убывание)</option>
                        <option value="quantity_ascending">Количество контактов(возрастание)</option>
                    </select>
                </form>
            </div>
            <contact-component :addressBooks="{{ json_encode($addressBooks) }}"></contact-component>
        </div>
    </div>
@endsection
