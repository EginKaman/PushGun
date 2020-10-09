@extends('layouts.app')
@section('title', __('База знаний'))
@section('content')

    <main class="main">
        <div class="container">
            <section class="general">
                <div class="general__title">
                    <h1 class="title">@lang('База знаний')</h1>
                </div>
            </section>
            @foreach($categories as $category)
                <h2>{{ $category->title }}</h2>
                <section class="base">
                    <div class="base__wrap">
                        @foreach($category->manuals as $manual)
                            <div class="button_green"><span class="green_button_circle desplode-circle"></span>
                                <a href="{{ route('manual.show', $manual) }}"
                                   class="button_green_inner mails__filter_btn">
                                    <p class="button_text_container">{{ $manual->title }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>
    </main>
@endsection
