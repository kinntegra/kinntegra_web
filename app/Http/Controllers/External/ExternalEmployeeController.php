<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use App\Services\MyServices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ExternalEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = MyServices::getdecryptNo($request->id);
        $data = $this->marketService->getExternalEmployee($id);
        //dd($data);
        return view('external.terms');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'user_agree' => 'required_if:userstatus,0',
            'reject_reason' => 'required_if:userstatus,1',
        ], [
            'user_agree.required_if' => 'Please accept terms and conditions',
            'reject_reason.required_if' => 'Please provide some input',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'success' => 'false',
                'errors'  => $v->getMessageBag()->toArray(),
            ], 400);
        }
        $data = $request->all();
        $employee = $this->marketService->updateExternalEmployeeStatus($data);
        return response()->json($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = MyServices::getdecryptNo($id);
        $data = $this->marketService->getExternalEmployee($id);
        //dd($data);
        return view('external.employee')->with([
            'data' => $data,
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
    public function rejected($id)
    {
        $id = MyServices::getdecryptNo($id);
        $data = $this->marketService->getExternalEmployee($id);
        return view('external.rejected');
    }
}
