<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plans;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plans::all();        
        foreach ($plans as $plan){            
            collect($plan)->put('project', $plan->project);
            if($plan->id_user_fri != null){
                collect($plan)->put('user_fri', $plan->user_fri);
            } 
            if($plan->id_user_mo != null){
                collect($plan)->put('user_mo', $plan->user_mo);
            }else{
                collect($plan)->put('user_mo', []);
            }   
            if($plan->id_user_sa != null){
                collect($plan)->put('user_sa', $plan->user_sa);
            }   
            if($plan->id_user_su != null){
                collect($plan)->put('user_su', $plan->user_su);
            }   
            if($plan->id_user_thu != null){
                collect($plan)->put('user_thu', $plan->user_thu);
            }   
            if($plan->id_user_tu != null){
                collect($plan)->put('user_tu', $plan->user_tu);
            }   
            if($plan->id_user_we != null){
                collect($plan)->put('user_we', $plan->user_we);
            }              
        };
        return $plans;     
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
        //
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
        $plan = Plans::find($id);
        if($request->user_mo){
            $plan->id_user_mo = $request->user_mo['id'];
        }
        if($request->user_tu){
            $plan->id_user_tu = $request->user_tu['id'];
        }
        if($request->user_we){
            $plan->id_user_we = $request->user_we['id'];
        }
        if($request->user_thu){
            $plan->id_user_thu = $request->user_thu['id'];
        }
        if($request->user_fri){
            $plan->id_user_fri = $request->user_fri['id'];
        }
        if($request->user_sa){
            $plan->id_user_sa = $request->user_sa['id'];
        }
        if($request->user_su){
            $plan->id_user_su = $request->user_su['id'];
        }
        $plan->save();        
        return [
            'status' => true,
            'plan' => $plan            
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
        //
    }
}
