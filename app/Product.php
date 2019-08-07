<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    protected $fillable = [
        'brand_id','model','year','seller','phone','description', 'price','sold','phone','description', 'approved', 'published_by'
    ];

    public function productable()
    {
        return $this->morphTo();
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
}
