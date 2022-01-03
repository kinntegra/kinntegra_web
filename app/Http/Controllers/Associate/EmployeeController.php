<?php

namespace App\Http\Controllers\Associate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Associate\EmployeeRequest;
use App\Services\MarketService;
use App\Services\MyServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class EmployeeController extends Controller
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
    public function index()
    {
        $data = [];
        if(Auth::user()->hasRole('admin'))
        {
            $user_id = Auth::user()->service_id;
            $associate = $this->marketService->getUserAssociate($user_id);
            $data['associate_id'] = $associate->id;
        }

        if(Auth::user()->hasRole('employee'))
        {
            $employee = $this->marketService->getSingleEmployee(Auth::user()->service_id);
            $data['associate_id'] = $employee->associate_id;
        }
        //dd('shasih');
        $employees = $this->marketService->getEmployees($data);
        //dd($employees);
        return view('associate.employee-index')
            ->with([
                'employees' => $employees,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 1;
        $associates = $this->marketService->getAssoicates($active);
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
        $details = 0;
        return view('associate.create-employee')
            ->with([
                'associates' => $associates,
                'user_associate' => $user_associate,
                'countries' => $countries,
                'departments' => $departments,
                'designations' => $designations,
                'supervised' => $supervised,
                'details' => $details,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->all();
        //dd('shashi');
        //return response()->json($data);
        $id = $request->associate_id;
        foreach($data as $key => $value) {

            if(Str::endsWith($key, '_upload'))
            {
                if($request->hasFile($key))
                {
                    $data[$key] = fopen($request->$key->path(), 'r');
                }
            }

        }

        if(!empty($request->ria_certificate_type))
        {
            $data['ria_certificate_type'] = json_encode($request->ria_certificate_type);
        }
        if(!empty($request->mfd_ria_certificate_type))
        {
            $data['mfd_ria_certificate_type'] = json_encode($request->mfd_ria_certificate_type);
        }
        if(!empty($request->ca_cs_certificate_type))
        {
            $data['ca_cs_certificate_type'] = json_encode($request->ca_cs_certificate_type);
        }

        $employee = $this->marketService->setEmployees($data,$id);

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

        $dcrypt = Crypt::decrypt($id);
        $id = explode('-',$dcrypt);

        $employee = $this->marketService->getEmployee($id[0], $id[1]);

        $name  = $employee->name;
        $data = 'Employee send for Supervisior Verification';

        return view('associate.success', compact('name','data'));
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

    public function showMessage($id)
    {
        $eid = MyServices::getdecryptNo($id);

        $data = $this->marketService->getSingleEmployee($eid);
        $download = $this->marketService->getDownloadEmployee($eid);

        return view('associate.employee-message')->with([
            'download' => $download,
            'data' => $data,
            'id' => $id,
        ]);
    }

    public function showLogs($id)
    {
        $eid = MyServices::getdecryptNo($id);

        $logs = $this->marketService->getLogsEmployee($eid);
        $logs = $logs->logs;
        //dd($logs);
        foreach($logs as $log)
        {
            $log->created_time = Carbon::parse($log->created_at)->format('h:m:s A');
            $log->created_day = Carbon::parse($log->created_at)->format('l, jS F Y');
        }
        return response()->json($logs);
    }

    public function resetPassword($id)
    {
        $eid = MyServices::getdecryptNo($id);
        $employee = $this->marketService->getSingleEmployee($eid);
        $data = [];
        $data['username'] = $employee->pan_no;
        $success = $this->marketService->forgotPassword($data);
        return response()->json($success);
    }
}
