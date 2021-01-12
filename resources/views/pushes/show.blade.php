@extends('layouts.app')
@section('title', __('Рассылка') ." {$push->title}")
@section('content')
    <main class="main single-mail">
        <div class="container">
            <section class="mail">
                <div class="general__title">
                    <h1 class="title">{{ $push->title }}</h1>
                    <a href="{{ route('push.index') }}" class="button_rb mail__button">
                        <span class="rb_button_circle"></span>
                        <button class="button_rb_inner mail__button_inner">
                            <p class="rb_button_text_container">
                                @lang('Мои рассылки') →
                            </p>
                        </button>
                    </a>
                </div>
                <div class="mail__time-sent">
                    @if(!empty($push->image))
                        <img src="{{ asset(Storage::url($push->image)) }}">
                    @elseif(!empty($push->site->image))
                        <img src="{{ asset(Storage::url($push->site->image)) }}">
                    @else
                        <img src="{{ asset('images/site.svg') }}">
                    @endif
                    <p>@lang('Отправлено'): {{ $push->created_at }}</p>
                </div>
                <div class="general__status">
                    <div class="general__subs mail__go">
                        <p class=""><span>{{ $push->transitions_count }}</span> @lang('переходов')</p>
                        <p class="percent">50%</p>
                    </div>
                    <div class="progress">
                        <progress max="100" value="{{ $push->transitions_count }}"></progress>
                        <div class="progress_bg">
                            <div class="progress_bar"></div>
                        </div>
                    </div>
                </div>
                <div class="general__stats_left">
                    <div class="general__stats_left-item" style="background: #5BA4D7;">
                        <h3>{{ $push->sent }}</h3>
                        <div class="mb-10">
                            <p class="medium">@lang('отправлено')</p>
                        </div>
                    </div>
                    <div class="general__stats_left-item" style="background: #9698D5;">
                        <h3>{{ $push->delivered }}</h3>
                        <p class="medium mb-10">
                            {{ round(($push->delivered / $push->sent)*100, 2) }}% @lang('доставлено')
                        </p>
                    </div>
                    <div class=" general__stats_left-item" style="background: #FF7226;">
                        <h3>{{ $push->transitions_count }}</h3>
                        <div class="mb-10">
                            <p class="medium">
                                {{ round(($push->delivered / $push->transitions_count)*100, 2) }}
                                % @lang('переходов')
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mail__info">
                    {{--                    <dl class="mail__info_item">--}}
                    {{--                        <dt class="mail__info_title">@lang('В очереди на доставку')</dt>--}}
                    {{--                        <dd class="mail__info_desc">0</dd>--}}
                    {{--                    </dl>--}}
                    <dl class="mail__info_item">
                        <dt class="mail__info_title">@lang('Отправлено')</dt>
                        <dd class="mail__info_desc">0</dd>
                    </dl>
                    <dl class="mail__info_item">
                        <dt class="mail__info_title">@lang('Список получателей')</dt>
                        <dd class="mail__info_desc">{{ $site->link }}</dd>
                    </dl>
                    <dl class="mail__info_item">
                        <dt class="mail__info_title">@lang('Заголовок')</dt>
                        <dd class="mail__info_desc">{{ $push->title }}</dd>
                    </dl>
                    <dl class="mail__info_item">
                        <dt class="mail__info_title">@lang('Текст уведомления')</dt>
                        <dd class="mail__info_desc">{{ $push->text }}</dd>
                    </dl>
                    <dl class="mail__info_item">
                        <dt class="mail__info_title">@lang('Ссылка')</dt>
                        <dd class="mail__info_desc">
                            {{ $push->link }}
                        </dd>
                    </dl>
                </div>
            </section>
        </div>
    </main>
@endsection
