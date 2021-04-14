@extends('layouts.app')
@section('title', __('Нстройки сервиса'))
@section('content')
    <main class="main email-push-show">
        <div class="container setting-mailing">
            <section class="mails">
                <div class="general__title">
                    <h1 class="title">@lang('Настройки сервиса')</h1>
                </div>
                <setting-mailing-component :emailSenders="{{ json_encode($emailSenders) }}"></setting-mailing-component>
                {{
                    $emailSenders->links()
                }}
            </section>
        </div>
    </main>
@endsection
