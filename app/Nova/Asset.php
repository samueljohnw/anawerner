<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Boolean;

class Asset extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Asset>
     */
    public static $model = \App\Models\Asset::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title',
    ];

    /**
     * The number of resources to show per page via relationships.
     *
     * @var int
     */
    public static $perPageViaRelationship = 25;

     public static function label()
     {
        return 'Posts';
     }


     public static function singularLabel()
     {
         return 'Video or File';  // The new singular title for the resource
     }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable()->hideFromIndex()->hideFromDetail(),
            Text::make('Title')->sortable()->rules('required'),
            Slug::make('Slug')->from('Title')->separator('-')->hideFromIndex(),
            Image::make('Featured Image', 'featuredImage')->disk('public')->path('uploads')->prunable(),            
            Trix::make('Description')->hideFromIndex(),
            BelongsTo::make('Course', 'course', \App\Nova\Course::class)->searchable(),
            URL::make('Url')->rules('required')->hideFromIndex(),
            Number::make('Order')->rules('required')->hideFromIndex(),
            Select::make('Status')
            ->options([
                'draft' => 'Draft',
                'published' => 'Published',
            ])
            ->displayUsingLabels()
            ->rules('required')
            ->filterable(), 
            Boolean::make('Is Live')->hideFromIndex(),
            DateTime::make('Published At')->rules('required')->displayUsing(function ($value) {
                return date("'F jS Y h:i:s A'", strtotime($value)); 
            }) 
            
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
