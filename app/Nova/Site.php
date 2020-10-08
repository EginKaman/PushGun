<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Text;

class Site extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Site::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'link';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'link'
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Сайты');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Сайт');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Пользователь', 'user', User::class)
                ->rules('required', 'max:255'),
            Image::make('Картинка сайта', 'image')
                ->sortable()
                ->required(),
            Text::make('Ссылка', 'link')
                ->sortable()
                ->required()
                ->rules('required', 'url', 'string', 'max:255'),
            Select::make('Запрос при', 'request')->options([
                'visit' => 'Открытии сайта',
                'click' => 'Клике на элемент',
                'intermediate' => 'Промежуточный запрос',
            ])
                ->default(function () {
                    return 'visit';
                })
                ->hideFromIndex()
                ->displayUsingLabels()
                ->required()
                ->rules('required', 'string', Rule::in(['visit', 'click', 'intermediate'])),
            Boolean::make('Скрывать на мобильных устройствах', 'mobile')
                ->sortable(),
            Boolean::make('Установлено', 'installed')
                ->exceptOnForms()
                ->sortable(),
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
            HasMany::make('Рассылки', 'mails', Push::class)
                ->sortable(),
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
