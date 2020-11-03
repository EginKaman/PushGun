@extends('layouts.app')
@section('title', $blog->title)
@section('content')

<main class="main">
    <section class="item-blog">
    <img src="{{ asset('images/testing.png') }}" alt="">
        <div class="container">
            <div class="item-blog__offer">
                <div class="section-blog__content">
                    <a class="section-item__title">
                        <p>{{ $blog->title }}</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-content">
        <div class="container">
            <div class="blog-content__wrapper">
                {!! Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($blog->text); !!}
            </div>
        </div>
    </section>
</main>
@endsection
