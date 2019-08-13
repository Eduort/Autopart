<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Car;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $validCars =  Product::where('approved' ,'=' ,1)->where('productable_type' ,'=' ,'App\Car')->pluck('productable_id');


        $cars = Car::whereIn('id',$validCars)->get();

        return view('panel/cars/index', compact('cars',$cars));
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
        return view('panel/cars/create', compact('brands',$brands));
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
            'brand' => 'required',
            'año' => 'required|digits:4',
            'precio' => 'required|numeric',
            'works' => 'required',
            'modelo' => 'required',
            'sell_parts' => 'required',
            'vendedor' => 'required',
            'telefono' => 'numeric',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);

        //Se guarda la imagen y se genera la ruta.
        $image_name=$request->file('imagen')->hashName();
        $request->file('imagen')->store('/cars/', ['disk' => 'public']);
        $image_route = '/uploads/cars/' . $image_name;


        //Se crea el ojbeto principal producto.
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

        //Si el usuario que crea el registro es administrador se aprueba por defecto.
        if(Auth::user()->role==1)
        {
            $product->approved = true;
        }

        $product->save();

        //Se crea el objeto auto.
        $car = Car::create([
            'works'=>request('works'),
            'sell_parts'=>request('sell_parts'),
            'image'=>$image_route
        ]);
        $car->save();

        //Se asocian los datos de proudcto al auto creado.
        $car->product_data()->save($product);

        //Se redirige al catalogo despues de crear el registro.

        if(Auth::user()->role==1)
        {
            session()->flash('status', 'El Auto ha sido registrado en el catalogo correctamente');
        }
        else
        {
            session()->flash('status', 'El Auto se ha registrado, se publicara cuando sea aprobado por un administrador.');
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
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
        if(Auth::user()->role==1)
        {
            $brands = Brand::all(['id', 'name']);
            return view('panel/cars/edit',compact('car','brands'));
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
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        //
        //Se validan los campos del formulario.
        $this->validate($request, [
            'brand' => 'required',
            'año' => 'required|digits:4',
            'precio' => 'required|numeric',
            'works' => 'required',
            'modelo' => 'required',
            'sell_parts' => 'required',
            'vendedor' => 'required',
            'telefono' => 'numeric',
            'descripcion' => 'required'
        ]);

        $prudct = Product::find($car->product_data->id);

        $prudct->brand_id = request('brand');
        $prudct->model = request('modelo');
        $prudct->year = request('año');
        $prudct->seller = request('vendedor');
        $prudct->phone = request('telefono');
        $prudct->description = request('descripcion');
        $prudct->price = request('precio');
        $prudct->save();

        if($request->hasFile('imagen'))
        {
            //Se guarda la imagen y se genera la ruta.
            $image_name=$request->file('imagen')->hashName();
            $request->file('imagen')->store('/cars/', ['disk' => 'public']);
            $image_route = '/uploads/cars/' . $image_name;
            $car->image = $image_route;
        }

        $car->works = request('works');
        $car->sell_parts = request('sell_parts');
        $car->save();

        session()->flash('status', 'El Auto ha sido actualizado correctamente');
        return redirect('/panel/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //

    }

    public function delete(Car $car)
    {
        //
        if(Auth::user()->role==1)
        {
            $car->delete();
            session()->flash('status', 'El Auto ha sido eliminado correctamente');
            return redirect('panel/cars');
        }
        else
        {
            return view('panel/errors/403');
        }
    }

    public function sold(Car $car)
    {
        $prudct = Product::find($car->product_data->id);
        $prudct->sold = true;
        $prudct->save();
        session()->flash('status', 'El Auto ha sido marcado como vendido');
        return redirect('panel/cars');
    }
}
