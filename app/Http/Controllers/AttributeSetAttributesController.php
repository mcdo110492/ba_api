<?php

namespace App\Http\Controllers;

use App\AttributeSetAttributes;
use Illuminate\Http\Request;

use App\Http\Requests\AttributeSetAttributesRequest;

class AttributeSetAttributesController extends Controller
{
    /**
     * Display a listing of the resource by Attribute Set.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $get = AttributeSetAttributes::with("attributes")->where(['set_id' => $id])->get();

        return response()->json(['payload' => ['data' => $get]]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeSetAttributesRequest $request)
    {
        $store = AttributeSetAttributes::create($request->all());

        return response()->json(['payload' => ['message' => 'Created', 'data' => $store]], 201);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeSetAttributesRequest $request, $id)
    {
        $attr = AttributeSetAttributes::findOrFail($id);

        $attr->update($request->all());

        $get = AttributeSetAttributes::find($id);

        return response()->json(['payload' => ['message' => 'Updated', 'data' => $get]]);
    }
}
