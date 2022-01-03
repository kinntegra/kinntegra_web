<?php

namespace App\Http\Controllers\Admin\MasterUpload;

use App\Http\Controllers\Controller;
use App\Services\MarketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class NavMasterController extends Controller
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
        // $nav_master = $this->marketService->getNavMaster();
        // dd($nav_master);
        if($request->ajax())
        {
            $navmasters = $this->marketService->getNavMaster();

            return Datatables::of($navmasters)
                    ->addIndexColumn()
                    ->addColumn('action', function($navmasters){

                           $btn = '<div class="dropdown text-right">';
                           $btn .= '<a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                           $btn .= '<i class="icon-dots"></i>';
                           $btn .= '</a>';
                           $btn .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">';
                           $btn .= '<a class="dropdown-item" href="javascript:void(0)" onclick="return viewEditFunction('.$navmasters->id.',0);">View Details</a>';
                           $btn .= '<a class="dropdown-item" href="javascript:void(0)" onclick="return viewEditFunction('.$navmasters->id.',1);">Edit Details</a>';
                           $btn .= '</div>';
                           $btn .= '</div>';

                            return $btn;
                    })
                    ->editColumn('nav_date', function ($navmasters)
                    {
                        //change over here
                        return date('d-m-Y', strtotime($navmasters->nav_date) );
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }else{
            return view('admin.master_view.nav_master');
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master_upload.nav_master');
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
                'nav_upload' => 'required|mimes:csv,xlsx,xls',
            ],
            [
                'nav_upload.required' => 'Please upload file',
                'nav_upload.mimes' => 'Please upload only excel file'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data['nav_upload'] = fopen($request->nav_upload->path(), 'r');
        $bank_master = $this->marketService->uploadNavMaster($data);

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
