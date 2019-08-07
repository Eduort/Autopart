<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autopart extends Model
{
    //
    public function product_data()
    {
        return $this->morphOne('App\Product', 'productable');
    }
}
