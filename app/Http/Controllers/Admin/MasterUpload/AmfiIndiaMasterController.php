<?php

namespace App\Http\Controllers\Admin\MasterUpload;

use App\Http\Controllers\Controller;
use App\Services\MarketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class AmfiIndiaMasterController extends Controller
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
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $amficodes = $this->marketService->getAmfiMaster();
            return Datatables::of($amficodes)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<div class="dropdown text-right">';
                           $btn .= '<a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                           $btn .= '<i class="icon-dots"></i>';
                           $btn .= '</a>';
                           $btn .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">';
                           $btn .= '<a class="dropdown-item" href="#">View Details</a>';
                           $btn .= '<a class="dropdown-item" href="#">Edit Details</a>';
                           $btn .= '</div>';
                           $btn .= '</div>';

                            return $btn;
                    })
                    ->editColumn('launch_date', function ($amficodes)
                    {
                        //change over here
                        return date('d-m-Y', strtotime($amficodes->launch_date) );
                    })
                    ->editColumn('closure_date', function ($amficodes)
                    {
                        //change over here
                        return date('d-m-Y', strtotime($amficodes->closure_date) );
                    })
                    ->rawColumns(['action'])

                    ->make(true);
        }else{
            return view('admin.master_view.amfi_india');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master_upload.amfi_india');
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
                'amfischemecode_upload' => 'required|mimes:csv,xlsx,xls,txt',
            ],
            [
                'amfischemecode_upload.required' => 'Please upload file',
                'amfischemecode_upload.mimes' => 'Please upload only excel or txt file'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data['amfischemecode_upload'] = fopen($request->amfischemecode_upload->path(), 'r');
        $bank_master = $this->marketService->uploadAmfiMaster($data);

        if($bank_master->status == 1)
        {
            return redirect()->back()->with('success', [$bank_master->remarks]);
        }
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


}
