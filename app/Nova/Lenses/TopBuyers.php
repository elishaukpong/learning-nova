<?php

namespace App\Nova\Lenses;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;

class TopBuyers extends Lens
{
    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
//            $query
//                ->select(DB::Raw('users.id as `id`, users.name as `name`, sum(products.price) as `total`'))
//                ->join('orders', 'users.id', '=', 'orders.user_id')
//                ->join('products', 'products.id', '=', 'orders.product_id')
//                ->groupBy('users.id')
//

            $query->from(function($query){
                $query->from('users')
                    ->select(DB::Raw('users.id as `id`, users.name as `name`, sum(products.price) as `total`'))
                    ->join('orders', 'users.id', '=', 'orders.user_id')
                    ->join('products', 'products.id', '=', 'orders.product_id')
                    ->groupBy('users.id');
            },'users')->select('id','name','total')

        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')
                ->sortable(),
            Text::make('Name')
                ->sortable(),
            Text::make('Total')
                ->sortable(),
        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'top-buyers';
    }
}
