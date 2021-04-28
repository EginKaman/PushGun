<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class TariffEmail extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\TariffEmail::class;

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
        'name'
    ];
    public static function label()
    {
        return __('Почтовые тарифы');
    }

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
            Text::make('Заголовок', 'name')
                ->sortable()
                ->rules('required', 'max:255'),
            Currency::make('Цена за месяц', 'price_per_month')->currency('RUB')->sortable(),
            Currency::make('Цена за год', 'price_per_year')->currency('RUB')->sortable(),
            Number::make('Макс. кол-во контактов', 'max_contacts')
                ->sortable(),
            HasMany::make('Пользователи', 'users', User::class)
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
