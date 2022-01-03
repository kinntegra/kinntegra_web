<?php

namespace App\Http\Controllers\Associate;

use App\Http\Controllers\Controller;
use App\Services\MarketService;
use App\Services\MyServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;

class AssociateEmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');

        parent::__construct($marketService);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $employee = $this->marketService->getAssoicateEmployees($id);

        return response()->json($employee);
    }

    /**
     *  Show the Uper deisgnation name
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, Request $request)
    {
        $employee = $this->marketService->getEmployeeSupervisior($id, $request->designation_id);

        return response()->json($employee);
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
    public function show($aid,$eid,Request $request)
    {
        $aid = MyServices::getdecryptNo($aid);
        $eid = MyServices::getdecryptNo($eid);
        $employee = $this->marketService->getEmployee($aid, $eid);
        //dd($employee);
        if($request->ajax())
        {
            return response()->json($employee);
        }
        if($employee->status == 2)
        {
            $name = $employee->name .' - Created/Updated Successfully';
            $data = 'Employee send for Supervisior Verification';
        }
        elseif($employee->status == 3 || $employee->status == 5)
        {
            $name = 'Verification process for '. $employee->name . ' is completed';
            $data = 'Details send to Employee for self verification';
        }
        elseif($employee->status == 4)
        {
            $name = 'Verification process for '. $employee->name . ' is completed & Rejected';
            $data = 'Employee Details is send again for further updates as mentioned in rejection reason.';
        }else{
            return redirect()->back();
        }
        return view('associate.success', compact('name','data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($aid,$eid)
    {
        $aid = MyServices::getdecryptNo($aid);
        $eid = MyServices::getdecryptNo($eid);

        $download = [];
        $details = 0;
        $data = $this->marketService->getEmployee($aid, $eid);
        //dd($data);
        $associates = $this->marketService->getAssoicates();
        $user_associate = '';
        if(Auth::user()->hasRole('Admin'))
        {
            $user_associate = $this->marketService->getUserAssociate(Auth::user()->service_id);
        }
        $countries = $this->marketService->getCountryList();
        $departments = $this->marketService->getDepartmentList();
        //$subdepartment = $this->marketService->getSubDepartmentList('1');
        $designations = $this->marketService->getDesignationList();
        $supervised = $this->marketService->getSupervisiorList();
        if($data->status == 10 || $data->status == 8)
        {
            $download['path'] = $this->marketService->getDownloadEmployee($eid);
            $download['name'] = basename($download['path']);

        }
        return view('associate.create-employee')
            ->with([
                'data' => $data,
                'associates' => $associates,
                'user_associate' => $user_associate,
                'countries' => $countries,
                'departments' => $departments,
                'designations' => $designations,
                'supervised' => $supervised,
                'details' => $details,
                'download' => $download,
        ]);
    }

    public function showDetail($aid,$eid)
    {
        $aid = MyServices::getdecryptNo($aid);
        $eid = MyServices::getdecryptNo($eid);

        $download = [];
        $details = 1;
        $data = $this->marketService->getEmployee($aid, $eid);
        //dd($data);
        $associates = $this->marketService->getAssoicates();
        $user_associate = '';
        if(Auth::user()->hasRole('Admin'))
        {
            $user_associate = $this->marketService->getUserAssociate(Auth::user()->service_id);
        }
        $countries = $this->marketService->getCountryList();
        $departments = $this->marketService->getDepartmentList();
        //$subdepartment = $this->marketService->getSubDepartmentList('1');
        $designations = $this->marketService->getDesignationList();
        $supervised = $this->marketService->getSupervisiorList();
        if($data->status == 10 || $data->status == 8)
        {
            $download['path'] = $this->marketService->getDownloadEmployee($eid);
            $download['name'] = basename($download['path']);

        }
        return view('associate.create-employee')
            ->with([
                'data' => $data,
                'associates' => $associates,
                'user_associate' => $user_associate,
                'countries' => $countries,
                'departments' => $departments,
                'designations' => $designations,
                'supervised' => $supervised,
                'details' => $details,
                'download' => $download,
        ]);
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
