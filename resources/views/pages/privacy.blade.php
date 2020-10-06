@extends('layouts.app')
@section('title', __('Политика конфиденциальности'))
@section('content')

<main class="main">
    <div class="container">
        <section class="general">
            <div class="general__title">
                <h1 class="title">@lang('Политика конфиденциальности')</h1>
            </div>

            {!! trans('privacy.text') !!}

        </section>
    </div>
</main>
@endsection