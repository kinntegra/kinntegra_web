<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $data['parent_id'] = $request->id;
        $data['id'] = isset($request->main_id) ? $request->main_id : '';
        $data['name'] = isset($request->name) ? $request->name : '';
        //dd($data);
        $subdepartment = $this->marketService->getSubDepartmentList($data);
        //dd($subdepartment);
        if($request->ajax())
        {
            return response()->json($subdepartment);
        }

        return view('admin.master_bse.department')->with([
            'departments' => $subdepartment,
        ]);
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
        $data = $request->all();
        $validator = Validator::make($data, [
                'name' => 'required',
                'code' => 'required',
            ],
            [
                'name.required' => 'Please enter name',
                'code.required' => 'Please enter code'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => 'false',
                'errors'  => $validator->errors(),
            ], 400);
        }
        //dd($data);
        $subdepartment = $this->marketService->setSubDepartment($data);
        //dd($subdepartment);
        if($request->id == null)
        {
            $message = 'Record added successfully';
        }else{
            $message = 'Record updated successfully';
        }

        return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $data = $request->all();
        $data['parent_id'] = $id;
        $subdepartment = $this->marketService->getSubDepartmentList($data);
        $department = $this->marketService->getDepartment($id);

        if($request->ajax())
        {
            return response()->json($subdepartment);
        }
        return view('admin.master_bse.subdepartment')->with([
            'departments' => $subdepartment,
            'parent_id' => $id,
            'depart' => $department,
        ]);
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
