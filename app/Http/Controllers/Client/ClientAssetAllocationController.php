<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientAssetAllocationController extends Controller
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
        $client = $this->marketService->getClientDetail($request->id);
        //dd($client->client_profiles);
        foreach ($client->client_profiles as $profile) {
            $data = [];
            $data['id'] = $request->id;
            $data['current_pid'] = $profile->id;
            $data['is_allocation'] = 1;
            foreach ($request->all() as $key => $value) {
                $keyexplode = explode('-', $key);
                if(isset($keyexplode[1]))
                {
                    if($keyexplode[1] == $profile->id)
                    {
                        $key = $keyexplode[0];
                        $data[$key] = $value;
                    }
                }
            }
            //dd($data);
            $assetallocation = $this->marketService->setClientDetails($data);
            //$assetallocation = $this->marketService->setClientKycInformation($request->id,$data);
        }
        return response()->json($assetallocation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = $this->marketService->getClientDetail($id);
        return view('client.assetallocation')
        ->with([
            'client_id' => $id,
            'client' => $client,
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
