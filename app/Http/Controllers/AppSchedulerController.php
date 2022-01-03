<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketService;

class AppSchedulerController extends Controller
{
    /**
     * Create a new controller instance
     * @return Void
     */
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth');
        parent::__construct($marketService);
    }
}
