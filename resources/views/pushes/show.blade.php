@extends('layouts.app')
@section('title', __('Рассылка') . $push->title)
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
                                Мои рассылки →
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
                    <p>Отправлено: {{ $push->created_at }}</p>
                </div>
                <div class="general__status">
                    <div class="general__subs mail__go">
                        <p class=""><span>500</span> переходов</p>
                        <p class="percent">50%</p>
                    </div>
                    <div class="progress">
                        <progress max="100" value="50"></progress>
                        <div class="progress_bg">
                            <div class="progress_bar"></div>
                        </div>
                    </div>
                </div>
                <div class="general__stats_left">
                    <div class="general__stats_left-item" style="background: #5BA4D7;">
                        <h3>{{ $site->push_subscriptions_count }}</h3>
                        <div class="mb-10">
                            <p class="medium">активных подписчиков</p>
                        </div>
                    </div>
                    <div class="general__stats_left-item" style="background: #9698D5;">
                        <h3>2</h3>
                        <p class="medium mb-10">100% доставлено</p>
                    </div>
                    <div class=" general__stats_left-item" style="background: #FF7226;">
                        <h3>2</h3>
                        <div class="mb-10">
                            <p class="medium">50% переходов</p>
                        </div>
                    </div>
                    <div class="general__stats_left-item" style="background: #D32626;">
                        <h3>2</h3>
                        <p class="medium mb-10">рассылок</p>
                    </div>
                </div>
                <div class="mail__info">
                    <dl class="mail__info_item">
                        <dt class="mail__info_title">В очереди на доставку</dt>
                        <dd class="mail__info_desc">0</dd>
                    </dl>
                    <dl class="mail__info_item">
                        <dt class="mail__info_title">Отправлено</dt>
                        <dd class="mail__info_desc">0</dd>
                    </dl>
                    <dl class="mail__info_item">
                        <dt class="mail__info_title">Список получателей</dt>
                        <dd class="mail__info_desc">{{ $site->link }}</dd>
                    </dl>
                    <dl class="mail__info_item">
                        <dt class="mail__info_title">Заголовок</dt>
                        <dd class="mail__info_desc">{{ $push->title }}</dd>
                    </dl>
                    <dl class="mail__info_item">
                        <dt class="mail__info_title">Текст уведомления</dt>
                        <dd class="mail__info_desc">{{ $push->text }}</dd>
                    </dl>
                    <dl class="mail__info_item">
                        <dt class="mail__info_title">Ссылка</dt>
                        <dd class="mail__info_desc">
                            {{ $push->link }}
                        </dd>
                    </dl>
                </div>
            </section>
        </div>
    </main>
@endsection
