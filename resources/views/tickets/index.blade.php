@extends('layouts.app')
@section('title', __('Техническая поддержка'))
@section('content')
    <main class="main support-body">
        <div class="container">
            <section class="account setgen">
                <div class="general__title">
                    <h1 class="title">@lang('Техническая поддержка')</h1>
                </div>
                <div class="mail__time-sent">
                    <p>@lang('Если вы сообщаете о проблеме, опишите её настолько подробно, насколько это возможно - это поможет её решить как можно быстрее.')</p>
                </div>

                <form action="{{ route('ticket.store') }}" class="sup-form" method="POST">
                    @csrf
                    <div class="sup-label">
                        <span class="">@lang('Отдел')</span>
                        <select id="department" name="department" class="sup-form__select">
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="name" class="sup-label">
                        <span class="">@lang('Имя')</span>
                        <input type="text" id="name" name="name" class="sup-input"
                               value="{{ old('name', Auth::user()->name) }}">
                    </label>
                    <label for="email" class="sup-label">
                        <span class="">@lang('Контактный E-mail')</span>
                        <input type="email" id="email" name="email" class="sup-input"
                               value="{{ old('email', Auth::user()->email) }}">
                    </label>
                    <label for="message" class="sup-label">
                        <span class="">@lang('Тема')</span>
                        <textarea id="message" name="message"
                                  class="sup-input sup-textarea">{{ old('message') }}</textarea>
                        <!-- <label for="file" class="sup-label sup-label-file">
                            <img src="{{ asset('images/file.svg') }}" alt="">
                            <input type="file" id="file" class="sup-input">
                        </label> -->
                    </label>
                    <div class="setgen__down-buttons small-btn">
                        <div class="button_green save__button small-btn">
                        <span class="green_button_circle">
                        </span>
                            <button type="submit" class="button_green_inner small-btn">
                                <p class="button_text_container small-btn">
                                    @lang('Отправить')
                                </p>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="mail__time-sent">
                    <p>@lang('Ваши заявки')</p>
                </div>

                <div class="tickets">
                    <table class="table-tickets">
                        <thead>
                        <tr>
                            <th>@lang('Тема')</th>
                            <th>@lang('Дата')</th>
                            <th>@lang('Статус')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>
                                    <a href="{{ route('ticket.show', 1) }}">
                                        {{ $ticket->message }}
                                    </a>
                                </td>
                                <td>{{ $ticket->created_at }}</td>
                                <td class="ticket-true">@lang('Есть ответ')</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
@endsection
