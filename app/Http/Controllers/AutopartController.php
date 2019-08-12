<?php

namespace App\Http\Controllers;

use App\Autopart;
use Illuminate\Http\Request;
use App\Brand;
use App\Product; 

class AutopartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $validAutoparts = Product::where('approved', '=', 1)->where('productable_type', '=', 'App\Autopart')->pluck('productable_id'); 
        
        $autoParts = Autopart::whereIn('id',$validAutoparts)->get();
        return view('panel/autoparts/index', compact('autoparts', $autoParts));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $brands = Brand::all(['id', 'name']);
        return view('panel/autoparts/create', compact('brands',$brands));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Se validan los campos del formulario.
        $this->validate($request, [
            'brand' => 'required', //Check
            'año' => 'required|digits:4', //Check
            'precio' => 'required|numeric', //Check
            'autopart_category' => 'required', //Check
            'modelo' => 'required', //Check
            'quantity' => 'required', //
            'vendedor' => 'required', //Check
            'telefono' => 'numeric', //Check
            'state' => 'required|numeric', //Check
            'reduction'=>'required|numeric', //Check
            'descripcion' => 'required', //Check
        ]);

        //Se crea el objeto principal producto 
        $product = Product::create([
            'brand_id'=>request('brand'),
            'model'=>request('modelo'),
            'year'=>request('año'),
            'seller'=>request('vendedor'),
            'phone'=>request('telefono'),
            'description'=>request('descripcion'),
            'price'=>request('precio'),
            'sold'=>0,
            'published_by' => auth()->user()->id
        ]);
        //Autenticación de Usuario Administrador: 
        if(Auth::user()->role==1)
        {
            $product->approved = true; 
        }

        //Guarda el objecto de tipo producto 
        $product->save(); 

        //Se crea el objeto autoparte.
        $autopartObject = Autopart::create([
            'autopart_category'=>request('category'),
            'quantity'=>request('quantity'),
            'state'=>request('state'),
            'car_price_reduction_on_sale'=>request('reduction')
        ]);

        $autopartObject->product_data()->save($product);

                //Se redirige al catalogo despues de crear el registro.

                if(Auth::user()->role==1)
                {
                    session()->flash('status', 'La nueva Autoparte se ha registrado en el catalogo correctamente');
                }
                else
                {
                    session()->flash('status', 'La Autoparte no se ha registrado, se publicara cuando sea aprobado por un administrador.');
                }
        
        
                if(request('parts')=="on")
                {
                    return redirect('/panel/autoparts/create');
                }
                else
                {
                    return redirect('/panel/cars');
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Autopart  $autopart
     * @return \Illuminate\Http\Response
     */
    public function show(Autopart $autopart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Autopart  $autopart
     * @return \Illuminate\Http\Response
     */
    public function edit(Autopart $autopart)
    {
        //
        if(Auth::user()->role==1)
        {
            $brands = Brand::all(['id', 'name']);
            return view('panel/autoparts/edit',compact('autopart','brands'));
        }
        else
        {
            return view('panel/errors/403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Autopart  $autopart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autopart $autopart)
    {
        $this->validate($request, [
            'brand' => 'required',
            'año' => 'required|digits:4',
            'precio' => 'required|numeric',
            'autopart_category' => 'required',
            'modelo' => 'required',
            'quantity' => 'required',
            'vendedor' => 'required',
            'telefono' => 'numeric',
            'state' => 'required|numeric',
            'reduction'=>'required|numeric',
            'descripcion' => 'required',
        ]);

        $prudct = Product::find($autopart->product_data->id);

        $prudct->brand_id = request('brand');
        $prudct->model = request('modelo');
        $prudct->year = request('año');
        $prudct->seller = request('vendedor');
        $prudct->phone = request('telefono');
        $prudct->description = request('descripcion');
        $prudct->price = request('precio');
        $prudct->save();

        $prudct->autopart_category=request('category');
        $prudct->quantity=request('quantity');
        $prudct->state=request('state');
        $prudct->car_price_reduction_on_sale=require('reduction');
        $prudct->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Autopart  $autopart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autopart $autopart)
    {
        //
    }

    public function delete(Autopart $autopart)
    {
        //
        if(Auth::user()->role==1)
        {
            $autopart->delete();
            session()->flash('status', 'La autoparte ha sido eliminada correctamente');
            return redirect('panel/autoparts');
        }
        else
        {
            return view('panel/errors/403');
        }
    }

    public function sold(Autopart $autopart)
    {
        $prudct = Product::find($autopart->product_data->id);
        $prudct->sold = true;
        $prudct->save();
        session()->flash('status', 'La autoparte ha sido marcado como vendido');
        return redirect('panel/autoparts');
    }
}
