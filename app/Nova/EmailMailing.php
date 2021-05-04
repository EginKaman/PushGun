<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use NovaButton\Button;

class EmailMailing extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\EmailMailing::class;
    public static function label()
    {
        return __('Почтовая рассылка');
    }
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make('Пользователь', 'user', User::class)
                ->rules('required', 'max:255'),
            BelongsTo::make('Письмо', 'emailMessage', EmailMessage::class),
            Boolean::make('Отправлено', 'is_sent'),
            Boolean::make('Разрешено', 'is_confirmed'),
            Number::make('Отправлено писем', 'number_of_sent'),
            Number::make('Не отправлено', 'number_of_not_sent'),
            Number::make('Доставлено', 'number_of_delivered'),
            DateTime::make('Дата создания', 'created_at'),
            Button::make('Разрешить')->event('App\Events\NovaButton\Events\NotifiedUserAboutNewsletter')->loadingText('Загрузка')->successText('Разрешено')->visible(!$this->is_confirmed)->reload()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
