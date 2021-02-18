@extends('layouts.app')
@section('title',__('Добавить новый сайт'))
@section('content')
<div class="main">
    <div class="container">
        <h2 class="subtitle">@lang('Мои сайты')</h2>
        <div class="general__sites">
            @foreach($sites as $site)
            <div class="general__sites_item">
                <div class="general__sites_item-more">
                    <div class="general__sites_item-more_imgcontsd">
                        <img src="{{ asset('images/more.svg') }}" alt="">
                    </div>

                    <ul class="general__sites_item_ul">
                        <li><a href="{{ route('push.create') }}">@lang('Отправить PUSH')</a></li>
                        <li><a href="{{ route('site.edit', $site) }}">@lang('Настройки сайта')</a></li>
                        <li>
                            <site-button-delete action="{{ route('site.destroy', $site) }}"></site-button-delete>
                        </li>
                    </ul>

                </div>
                <div style="display: flex; align-items: center">
                    <a href="{{ route('site.show', ['site' => $site]) }}">
                        @empty($site->image)
                        <img class="general__sites_item-img" src="{{ asset('images/site.svg') }}" alt="{{ $site->link }}">
                        @else
                        <img class="general__sites_item-img" src="{{ asset( Storage::url($site->image) ) }}" alt="{{ $site->link }}">
                        @endempty
                    </a>
                    <div class="general__sites_info @if($site->installed)checkmark @endif">
                        <a href="{{ route('site.show', $site) }}" class="account__bottom_subscribe general__sites_title">{{ $site->link }}</a>
                        <p>@lang('Подписчиков'): <span>{{ $site->push_subscriptions_count }}</span></p>
                    </div>
                </div>
                <ul class="general__sites_ul">
                    <li><a href="{{ route('push.create') }}"><img src="{{ asset('images/send-black.svg') }}" alt="">@lang('Отправить PUSH')</a></li>
                    <li><a href="{{ route('site.edit', $site) }}"><img src="{{ asset('images/setting.svg') }}" alt="">@lang('Настройки сайта')</a></li>
                    <li>
                        <site-button-delete action="{{ route('site.destroy', $site) }}"></site-button-delete>
                    </li>
                </ul>
            </div>
            @endforeach
        </div>
        <div class="button_white">
            <span class="white_button_circle"></span>
            <a href="{{ route('site.create') }}" class="button_white_inner">
                <p class="button_text_container">
                    <img class="button-img" src="{{ asset('images/add.svg') }}" alt="">@lang('Добавить новый сайт')
                </p>
            </a>
        </div>
    </div>
</div>
@endsection