<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Plans;
use Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Project::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
           [ 
               'name' => ['required']               
           ]               
        );
        if($validate->fails()){
            return ['message'=>$validate->messages(),
                    'obj'=>$request];
        }
        $project = Project::create([           
            'name' => $request->name                       
        ]);
        $plan = Plans::create([
            'id_project'=>$project->id
        ]);        
        return [
            'status' => true,
            'project' => $project            
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);        
        $project->name = $request->name;
        $project->save();        
        return [
            'status' => true,
            'project' => $project            
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id); 
        $project->delete();  
        $plan = Plans::where('id_project','=',$id)->get();
        $plan[0]->delete();     
        return [
            'status' => true            
        ];
        // return [
        //     'project'=>$project,
        //     'plan'=>$plan
        // ];
    }
}
