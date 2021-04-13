@extends('layouts.app')
@section('title', __('Редактор'))
@section('content')
    <div class="container">
        <div class="general__title">
            <h1 style="font-weight: 400; font-style: italic;">HTML Редактор</h1>
        </div>
        <div class="trumbowyg-wrapper">
            <div id="trumbowyg-demo"></div>
        </div>
        <div class="trumbowyg-inform">
            <p>Количество слов: <span class="trumbowyg-count">0</span></p>
            <p class="funcer">test</p>
            <div>
                <p>В теле письма необходимо указать информацию о том, как получатель подписался на вашу рассылку,
                    например:"Вы получили это письмо, так как <br>подписались на рассылку на сайте https://example.com"</p>
                <p>В шаблоне отсутствует ссылка на страницу отписки. Вставьте ее спользуя шорткод: {(unsubscribe_url}} или
                    она будет добавлена автоматически</p>
            </div>
        </div>
    </div>

@endsection
