<?php

namespace App\Http\Controllers;

use App\Projects;
use App\Http\Requests\ProjectRequest;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get = Projects::all();

        return response()->json(['payload' => ['data' => $get]]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $store = Projects::create($request->all());

        return response()->json(['payload' => ['message' => 'Created', 'data' => $store]]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Projects  $projects
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $project = Projects::findOrFail($id);

        $project->update($request->all());

        $get = Projects::find($id);

        return response()->json(['payload' => ['message' => 'Updated', 'data' => $get]]);
    }

 
}
