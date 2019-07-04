<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AttributeRequest;

use App\Attributes;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get = Attributes::all();

        return response()->json(['payload' => ['data' => $get]]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $store = Attributes::create($request->all());

        return response()->json(['payload' => ['message' => 'Created', 'data' => $store]], 201);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, $id)
    {
        $attr = Attributes::findOrFail($id);

        $attr->update($request->all());

        $get = Attributes::find($id);

        return response()->json(['payload' => ['message' => 'Updated', 'data' => $get]]);
    }
}
