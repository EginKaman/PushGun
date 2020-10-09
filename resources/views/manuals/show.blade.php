@extends('layouts.app')
@section('title', $manual->title)
@section('content')

    <main class="main">
        <div class="container">
            <section class="general">
                <div class="general__title">
                    <h1 class="title">{{ $manual->title }}</h1>
                </div>

                <p>
                    {!! Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($manual->text); !!}
                </p>

            </section>
        </div>
    </main>
@endsection
