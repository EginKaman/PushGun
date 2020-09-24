@extends('layouts.app')
@section('title', __('Тикет №') . $tiket->id)
@section('content')
    <div class="container">
        <section class="ticket">
            <div class="general__title"><h1 class="title">@lang('Просмотр тикета')</h1></div>
            <div class="mail__time-sent"><strong>@lang('Тема'):</strong>
                <p>@lang('Добрый вечер! Запускали рассылки с разницей примерно в 3 недели...')</p></div>
            <div class="ticket-wrap">
                <div class="ticket-avatar">
                    <figure><img src="{{ asset('img/user1.png') }}" alt=""></figure>
                </div>
                <div class="ticket-chat">
                    <div class="ticket-chat__top"><h3 class="ticket-name">Viktoria Lushenko<small>@lang('пишет')</small>
                        </h3><span class="ticket-data">Jan 30, 2019</span></div>
                    <div class="ticket-chat__text"><p>Здравствуйте,</p>
                        <p>Необходимо, чтобы данные записи были указаны на домене отправителя. У нас нет требований к
                            значениям данных записей.</p>
                        <p>Пожалуйста, протестируйте отправку на сколько адресов на email.ru и сообщите нам, если
                            проблема все еще существует.</p>
                        <p>Спасибо за содействие!</p><br><br>
                        <p>---</p>
                        <p>C уважением,</p>
                        <p>Виктория Лушенко</p>
                        <p>Служба поддержки пользователей PushGun</p>
                        <p>---</p>
                        <p>Для оценки ответа или его просмотра, пожалуйста, перейдите по ссылке:</p><a
                            href="http://pushgun.puzzlepro.ru/lk/main.html">http://pushgun.puzzlepro.ru/lk/main.html"</a>
                    </div>
                </div>
            </div>
            <div class="ticket-wrap">
                <div class="ticket-avatar">
                    <figure><img src="{{ asset('img/user.png') }}" alt=""></figure>
                </div>
                <div class="ticket-chat">
                    <div class="ticket-chat__top"><h3 class="ticket-name">Max Tsurka<small>@lang('пишет')</small></h3>
                        <span class="ticket-data">Jan 30, 2019</span></div>
                    <div class="ticket-chat__text"><p>Сейчас стоят такие настройки: <a
                                href="http://pushgun.puzzlepro.ru/lk/main.html">http://pushgun.puzzlepro.ru/lk/main.html</a>
                        </p><br><br>
                        <p>---</p>
                        <p>C уважением,</p>
                        <p>Цурка Максим</p>
                        <p>+ 1234567890</p><a href="mailto:examle@mail.ru">examle@mail.ru</a><br><a
                            href="http://pushgun.puzzlepro.ru/lk/main.html">pushgun.puzzlepro.ru</a><br><br><br><a
                            href="http://pushgun.puzzlepro.ru/lk/main.html"><img src="{{ asset('img/dark-logo.svg') }}"
                                                                                 alt=""></a><br><br>
                        <p>Служба поддержки пользователей PushGun</p></div>
                </div>
            </div>
            <div class="ticket-wrap">
                <div class="ticket-avatar">
                    <figure><img src="{{ asset('img/user1.png') }}" alt=""></figure>
                </div>
                <form action="" class="ticket-answer">
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                    <label for="ticketFile" class="ticket-file">
                        <span class="ticket-fileName"></span>
                        <img src="{{ asset('img/file.svg') }}" class="file-img" alt="">
                        <img src="{{ asset('img/remove.svg') }}" class="file-img-remove" alt="">
                        <input type="file" name="" id="ticketFile">
                    </label>
                    <div class="setgen__down-buttons ticket-btn">
                        <div class="button_green save__button"><span class="green_button_circle"></span>
                            <button type="submit" class="button_green_inner">
                                <p class="button_text_container">@lang('Отправить')</p>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
