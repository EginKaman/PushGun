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
                    <site-check script="{{ url("/storage/push/$site->script") }}"
                                archive="{{ url('/storage/pg-push.zip') }}"
                                action="{{ action('Api\CheckScriptController@index', $site) }}"
                                installed="{{ $site->installed }}"></site-check>
                </section>
            </article>
        </section>
    </div>
@endsection
