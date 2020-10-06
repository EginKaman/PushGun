@extends('layouts.app')
@section('title', __('Мои рассылки'))
@section('content')
    <main class="main mymailing">
        <div class="container">
            <section class="mails">
                <div class="filter__popup">
                    <div class="filter__popup__inner">
                        <div class="filter__popup_block w-50">
                            <label for="" class="filter__popup_label">@lang('Начальная дата')</label>
                            <input id="firstDate-input" class="datepicker-here filter__input" type="text">
                        </div>
                        <div class="filter__popup_block w-50">
                            <label for="" class="filter__popup_label">@lang('Конечная дата')</label>
                            <input id="lastDate-input" class="datepicker-here filter__input" type="text">
                        </div>
                        <div class="filter__popup_block">
                            <label for="" class="filter__popup_label">@lang('Текст')</label>
                            <input class="filter__input" type="text">
                        </div>
                        <div class="filter__popup_block">
                            <label for="site" class="filter__popup_label">@lang('Сайт')</label>
                            <select id="site" class="filter__input filter__selector" name="site" type="text">
                                @foreach($sites as $site)
                                    <option value="{{ $site->id }}">{{ $site->link }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="button_lb">
                            <span class="lb_button_circle">
                            </span>
                            <button class="button_lb_inner">
                                <p class="lb_button_text_container">
                                    @lang('Сброс')
                                </p>
                            </button>
                        </div>
                        <div id="btn_select" class="button_rb">
                            <span class="rb_button_circle">
                            </span>
                            <button class="button_rb_inner">
                                <p class="rb_button_text_container">
                                    @lang('Выбрать')
                                </p>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="general__title">
                    <h1 class="title">@lang('Мои рассылки')</h1>
                </div>
                <div class="mails__filter">
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
                <div class="general__sites">
                    @foreach($pushes as $push)
                        <div class="general__sites_item mails__sites">
                            <div class="flex">
                                <a href="{{ route('push.show', $push) }}">
                                    @if(!empty($push->image))
                                        <img class="general__sites_item-img"
                                             src="{{ asset(Storage::url($push->image)) }}">
                                    @elseif(!empty($push->site->image))
                                        <img class="general__sites_item-img"
                                             src="{{ asset(Storage::url($push->site->image)) }}">
                                    @else
                                        <img class="general__sites_item-img" src="{{ asset('images/site.svg') }}">
                                    @endif

                                </a>
                                <div class="general__sites_info mails__sites_info">
                                    <a href="{{ route('push.show', $push) }}">{{ $push->title }}</a>
                                    <p>
                                        <img src="{{ asset('images/mark.svg') }}" alt="">
                                        @lang('Отправлено'): {{ $push->created_at }}
                                    </p>
                                    <p>
                                        <img src="{{ asset('images/siteDark.svg') }}" alt="">
                                        {{ $push->link }}
                                    </p>
                                </div>
                            </div>
                            <div class="mails__sites_stats">
                                <div class="mails__sites_stats-item">
                                    <h3>{{ $push->sent }}</h3>
                                    <p>@lang('отправлено')</p>
                                </div>
                                <div class="mails__sites_stats-item">
                                    <h3>{{ $push->delivered }}</h3>
                                    <p>@lang('доставлено')</p>
                                </div>
                                <div class="mails__sites_stats-item">
                                    <h3>{{ $push->transitions_count }}</h3>
                                    <p>@lang('переходов')</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </main>
@endsection
