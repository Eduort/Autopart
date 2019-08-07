<?php

namespace App\Http\Controllers;

use App\Autopart;
use Illuminate\Http\Request;

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

        return view('panel/atuparts/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('panel/atuparts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

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
        return view('panel/atuparts/edit');
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
        //
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
}
