<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Carbon\Carbon;
use Laravel\Nova\Fields\Date;



class Purchase extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Purchase>
     */
    public static $model = \App\Models\Purchase::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'course.title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'user.name','user.email'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->hideFromIndex()->hideFromDetail(),
            BelongsTo::make('Course')
                ->searchable()
                ->required(),
            BelongsTo::make('User')
                ->searchable()
                ->required()
                ->display(function ($user) {
                    return $user->name . ' (' . $user->email . ')';
                }),

            Date::make('Purchased At', 'created_at')
                ->displayUsing(function ($value) {
                    return $value ? $value->format('F j, Y g:i A') : null;
                })
                ->sortable()
                ->default(now())
            
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
