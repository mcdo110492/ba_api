<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AttributeSetRequest;

use App\AttributeSet;

class AttributeSetController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get = AttributeSet::all();

        return response()->json(['payload' => ['data' => $get]]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeSetRequest $request)
    {
        $store = AttributeSet::create($request->all());

        return response()->json(['payload' => ['message' => 'Created', 'data' => $store]], 201);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeSetRequest $request, $id)
    {
        $set = AttributeSet::findOrFail($id);

        $set->update($request->all());

        $get = AttributeSet::find($id);

        return response()->json(['payload' => ['message' => 'Updated', 'data' => $get]]);
    }
}
