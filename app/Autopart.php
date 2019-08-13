<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autopart extends Model
{
    //

    protected $fillable = [
        'autopart_category','quantity','state', 'car_price_reduction_on_sale'
    ];

    public function product_data()
    {
        return $this->morphOne('App\Product', 'productable');
    }
}
