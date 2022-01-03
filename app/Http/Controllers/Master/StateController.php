<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $data = $request->all();
        $data['country_id'] = $id;
        $data['id'] = isset($request->id) ? $request->id : '';
        $data['name'] = isset($request->name) ? $request->name : '';
        $states = $this->marketService->getStateList($id, $data);
        $country = $this->marketService->getCountrySingle($id);
        if($request->ajax())
        {
            return response()->json($states);
        }
        return view('admin.master_bse.state')->with(['country' => $country,'country_id' => $id,'states' => $states]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($country_id, Request $request)
    {
        $data = [];
        $data['country_id'] = $country_id;
        $data['id'] = isset($request->id) ? $request->id : '';
        $data['name'] = isset($request->name) ? $request->name : '';
        //dd($data);
        $states = $this->marketService->getStateList($country_id,$data);

        return response()->json($states);
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
        //
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
