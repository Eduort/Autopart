<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //

    public function index()
    {
        if(Auth::user()->role==1)
        {
            $products = Product::where('approved', '=', 0)->get();
            return view('panel/products/index',compact('products'));
        }
        else
        {
            return view('panel/errors/403');
        }
    }

    public function approve(Product $product)
    {
        if(Auth::user()->role==1)
        {
            $product->approved = 1;
            $product->save();

            if($product->productable_type=='App\Car')
            {
                session()->flash('status', 'El Auto ha sido aprobado correctamente');
                return redirect('/panel/cars');
            }
            else
            {
                session()->flash('status', 'La autoparte ha sido aprobada correctamente');
                return redirect('/panel/autoparts');
            }


        }
        else
        {
            return view('panel/errors/403');
        }
    }
}
