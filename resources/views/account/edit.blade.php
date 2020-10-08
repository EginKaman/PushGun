@extends('layouts.app')
@section('title', __('Настройки аккаунта'))
@section('content')
    <main class="main">
        <div class="container">
            <section class="account setgen">
                <div class="general__title">
                    <h1 class="title">@lang('Настройки аккаунта')</h1>
                </div>


                <section id="general-sec" class="choosen">


                    <div class="setgen__buttons">
                        <div class="setgen__buttons_active">
                            @lang('Общие')
                        </div>
                        <div id="safe" class="setgen__buttons_link">
                            <div class="new-tab">@lang('Безопасность')</div>
                        </div>
                        <div id="notifications" class="setgen__buttons_link">
                            <div class="new-tab">@lang('Уведомления')</div>
                        </div>
                    </div>


                    <div class="setgen__info">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('account.update') }}" method="post" class="set-form"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label for="email" class="set-form__label email">
                                <span class="set-form__title">Email</span>
                                <input class="disable" type="email" name="email" id="email"
                                       value="{{ old('email', $user->email) }}"
                                       disabled>
                                <div class="set-change">
                                    <span class="set-form__val">{{ $user->email }}
                                        <img src="{{ asset('images/true.svg') }}" alt="" class="email_status">
                                    </span>
                                    <span class="set-form__link change-email">@lang('Изменить')</span>
                                </div>
                            </label>

                            <label for="name" class="set-form__label name">
                                <span class="set-form__title">@lang('Имя')</span>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
                            </label>

                            <label for="secName" class="set-form__label secName">
                                <span class="set-form__title">@lang('Фамилия')</span>
                                <input type="text" name="lastname" id="secName"
                                       value="{{ old('lastname', $user->lastname) }}">
                            </label>

                            <label for="phone" class="set-form__label phone">
                                <span class="set-form__title">@lang('Моб.телефон')</span>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
                            </label>

                            <div class="set-form__label">
                                <span class="set-form__title">@lang('Язык')</span>
                                <select id="lang" name="lang" class="set-form__select">
                                    <option value="ru">@lang('Русский')</option>
                                    <option value="en">@lang('Английский')</option>
                                </select>
                            </div>

                            <div class="set-form__label">
                                <span class="set-form__title">@lang('Часовой пояс')</span>
                                <select id="time" name="timezone" class="set-form__select">
                                    <option value="GMT+3">(UTC +03:00) Москва</option>
                                    <option value="GMT+4">(UTC +04:00) Ижевск</option>
                                </select>
                            </div>

                            <div class="set-form__label">
                                <span class="set-form__title">@lang('Страна')</span>
                                <select id="land" name="country" class="set-form__select">
                                    <option value="Россия">@lang('Россия')</option>
                                    <option value="Америка">@lang('Америка')</option>
                                </select>
                            </div>

                            <label for="city" class="set-form__label city">
                                <span class="set-form__title">@lang('Город')</span>
                                <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}">
                            </label>

                            <label for="address" class="set-form__label address">
                                <span class="set-form__title">@lang('Адрес')</span>
                                <input type="text" name="address" id="address"
                                       value="{{ old('address', $user->address) }}">
                            </label>

                            <label for="index" class="set-form__label index">
                                <span class="set-form__title">@lang('Индекс')</span>
                                <input type="text" name="postcode" id="index"
                                       value="{{ old('postcode', $user->postcode) }}">
                            </label>

                            <photo-component
                                @if($user->photo)
                                    image="{{ asset(Storage::url($user->photo)) }}"
                                @endif
                            ></photo-component>


                            <div class="set-bottom">
                                <div class="setgen__down-buttons small-btn">
                                    <div class="button_green save__button small-btn">
                                        <span class="green_button_circle"></span>
                                        <button type="submit" class="button_green_inner small-btn">
                                            <p class="button_text_container small-btn">@lang('Сохранить')</p>
                                        </button>
                                    </div>
                                </div>
                                <!-- <a href="" class="set-link">Редактировать дополнительную информацию</a> -->
                            </div>
                        </form>
                    </div>
                </section>


                <section id="safe-sec" class="setgen setint">
                    <div class="setgen__buttons setint__buttons">
                        <div id="general" class="setgen__buttons_link">
                            <div class="new-tab">@lang('Общие')</div>
                        </div>
                        <div id="safe" class="setgen__buttons_active">
                            <div class="new-tab">@lang('Безопасность')</div>
                        </div>
                        <div id="notifications" class="setgen__buttons_link">
                            <div class="new-tab">@lang('Уведомления')</div>
                        </div>
                    </div>
                    <div class="setgen__info">

                        <form action="{{ route('password.update') }}" method="post" class="set-form">
                            @csrf
                            @method('PUT')
                            <label for="oldPass" class="set-form__label oldPass">
                                <span class="set-form__title">@lang('Текущий пароль')</span>
                                <input type="password" name="old_password" id="oldPass">
                            </label>

                            <label for="newPass" class="set-form__label newPass">
                                <span class="set-form__title">@lang('Новый пароль')</span>
                                <input type="password" name="password" id="newPass">
                            </label>

                            <label for="confPass" class="set-form__label confPass">
                                <span class="set-form__title">@lang('Подтвердите пароль')</span>
                                <input type="password" name="password_confirmation" id="confPass">
                            </label>


                            <div class="set-bottom">
                                <div class="setgen__down-buttons small-btn">
                                    <div class="button_green save__button small-btn">
                                        <span class="green_button_circle"></span>
                                        <button type="submit" class="button_green_inner small-btn">
                                            <p class="button_text_container small-btn">@lang('Сохранить')</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </section>


                <section id="notifications-sec" class="setreq">
                    <div class="setgen__buttons">
                        <div id="general" class="setgen__buttons_link">
                            <div class="new-tab">@lang('Общие')</div>
                        </div>
                        <div id="safe" class="setgen__buttons_link">
                            <div class="new-tab">@lang('Безопасность')</div>
                        </div>
                        <div id="notifications" class="setgen__buttons_active">
                            @lang('Уведомления')
                        </div>
                    </div>
                    <div class="setgen__info setgen__info-notifc">


                        <form action="" method="post" class="set-form set-form-check">

                            <div class="form-row__wrap">
                                <div class="set-form-row">
                                    <span class="set-form-row__title">@lang('Настройка уведомлений'):</span>
                                    <div class="notifications-ckecks">
                                        <label for="check1" class="set-form__label-check">
                                            <input class="" type="checkbox" name="" id="check1" checked>
                                            <span
                                                class="set-form__title">@lang('Получать письма от администрации сервиса')</span>
                                        </label>

                                        <label for="check2" class="set-form__label-check">
                                            <input class="" type="checkbox" name="" id="check2" checked>
                                            <span class="set-form__title">
                                                @lang('Получать уведомления о модерации рассылок, адресных книг')
                                            </span>
                                        </label>

                                        <label for="check3" class="set-form__label-check">
                                            <input class="" type="checkbox" name="" id="check3" checked>
                                            <span class="set-form__title">
                                                @lang('Получать уведомления о каждом новом подписчике')
                                            </span>
                                        </label>

                                    </div>
                                </div>
                            </div>

                            <notifications public_key="{{ config('webpush.vapid.public_key') }}"></notifications>
                            <div class="form-row__wrap">
                                <div class="set-form-row">
                                    <span class="set-form-row__title">@lang('Push уведомления'):</span>
                                    <div class="notifications-ckecks">

                                        <label for="radio1" class="set-form__label-check">
                                            <input class="" type="radio" name="notification" id="radio1">
                                            <span
                                                class="set-form__title">@lang('Отключить получение push уведомлений')</span>
                                        </label>

                                        <label for="radio2" class="set-form__label-check">
                                            <input class="" type="radio" name="notification" id="radio2" checked>
                                            <span
                                                class="set-form__title">@lang('Получать уведомления по следующим событиям'):</span>
                                        </label>


                                        <div class="push-check">
                                            <label for="check4" class="set-form__label-check">
                                                <input class="" type="checkbox" name="" id="check4" checked>
                                                <span class="set-form__title">@lang('Рассылка отправлена')</span>
                                            </label>

                                            <label for="check5" class="set-form__label-check">
                                                <input class="" type="checkbox" name="" id="check5" checked>
                                                <span
                                                    class="set-form__title">@lang('Получать уведомления о модерации рассылок')</span>
                                            </label>

                                            <label for="check6" class="set-form__label-check">
                                                <input class="" type="checkbox" name="" id="check6" checked>
                                                <span class="set-form__title">@lang('Адресная книга загружена')</span>
                                            </label>

                                            <label for="check7" class="set-form__label-check">
                                                <input class="" type="checkbox" name="" id="check7" checked>
                                                <span class="set-form__title">@lang('Окончание подписки')</span>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="set-bottom">
                                <div class="setgen__down-buttons small-btn">
                                    <div class="button_green save__button small-btn">
                                        <span class="green_button_circle"></span>
                                        <button type="submit" class="button_green_inner small-btn">
                                            <p class="button_text_container small-btn">@lang('Сохранить')</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </section>

            </section>
        </div>
    </main>
@endsection
