<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Timezone;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */

    public static function label()
    {
        return __('Пользователи');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Пользователь');
    }

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Avatar::make('Фото', 'photo'),
            Text::make('Имя', 'name')
                ->sortable()
                ->rules('required', 'string', 'max:255'),
            Text::make('Фамилия', 'lastname')
                ->sortable()
                ->nullable()
                ->rules('nullable', 'max:255'),
            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules(function () {
                    return [
                        Rule::unique('users', 'email')->whereNull('deleted_at')
                    ];
                })
                ->updateRules(function () {
                    return [
                        Rule::unique('users', 'email')
                            ->ignore($this->resource->getKey())
                            ->whereNull('deleted_at')
                    ];
                }),
            Password::make('Пароль', 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),
            Timezone::make('Часовой пояс', 'timezone')
                ->hideFromIndex()
                ->nullable(),
            Text::make('Страна', 'country')
                ->hideFromIndex()
                ->nullable(),
            Text::make('Город', 'city')
                ->hideFromIndex()
                ->nullable(),
            Text::make('Адрес', 'address')
                ->hideFromIndex()
                ->nullable(),
            Number::make('Индекс', 'postcode')
                ->hideFromIndex()
                ->nullable(),
            Number::make('Баланс', 'balance')
                ->sortable(),
            BelongsTo::make('Тариф', 'tariff', Tariff::class)
                ->sortable(),
            DateTime::make('Окончание тарифа', 'tariff_expired_at')
                ->nullable(),
            DateTime::make(__('Deleted at'), 'deleted_at')
                ->onlyOnDetail()
                ->rules('nullable', 'date'),
            DateTime::make(__('Created at'), 'created_at')
                ->onlyOnDetail()
                ->showOnIndex()
                ->sortable()
                ->rules('nullable', 'date'),
            DateTime::make(__('Updated at'), 'updated_at')
                ->onlyOnDetail()
                ->rules('nullable', 'date'),
            HasMany::make('Сайты', 'sites', Site::class),
            HasMany::make('Рассылки', 'pushes', Push::class),
            HasMany::make('Платежи', 'payments', Payment::class),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
