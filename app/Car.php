<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'works','sell_parts','image'
    ];
    //
    public function product_data()
    {
        return $this->morphOne('App\Product', 'productable');
    }
}
