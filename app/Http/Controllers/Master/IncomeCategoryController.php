<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = isset($request->id) ? $request->id : '';
        $name = isset($request->name) ? $request->name : '';
        $income_categories = $this->marketService->getIncomeCategory($id, $name);

        if($request->ajax())
        {
            return response()->json($income_categories);
        }
        return view('admin.master_bse.other_income_category')->with(['incomes' => $income_categories]);
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
            ],
            [
                'name.required' => 'Please enter name',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => 'false',
                'errors'  => $validator->errors(),
            ], 400);
        }
        $income_category = $this->marketService->setIncomeCategory($data);
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
