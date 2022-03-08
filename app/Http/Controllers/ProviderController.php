<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\provider_details;
use App\Models\state;
use App\Models\provider_type;
use App\Models\Services;
use Illuminate\Support\Carbon;
use NunoMaduro\Collision\Contracts\Provider;

class ProviderController extends Controller
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
        $states=state::all();
        $services=Services::where('provider_id',3)->get();
        $provider_types=provider_type::where('provider_id',3)->get();
        return view('admin.provider.create',compact('states','provider_types','services'));
    }
    public function create2()
    {
        $states=state::all();
        $services=Services::where('provider_id',2)->get();
        $provider_types=provider_type::where('provider_id',2)->get();
        return view('admin.provider.createMeetingRoom',compact('states','provider_types','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = new User();
        $users-> name = $request->input('name');
        $users-> role_id = 5;
        $users-> status = 1;
        $users-> address1 = $request->input('add1');
        $users-> address2 =$request->input('add2');
        $users-> address3 = $request->input('add3');
        $users-> address4 = $request->input('add4');
        $users-> postcode = $request->input('postcode');
        $users-> states_id = $request->input('state');
        $users-> save();

        $start_time=Carbon::parse('08:30:00')->format('H:i');
        $end_time=Carbon::parse('17:30:00')->format('H:i');
        $start_rest_time=Carbon::parse('13:00:00')->format('H:i');
        $end_rest_time=Carbon::parse('13:00:00')->format('H:i');
        $providerDetails = new provider_details();
        $providerDetails->user_id = $users->id;
        $providerDetails->provider_id=3;
        $providerDetails->provider_type_id=$request->input('provider_type');
        $providerDetails->company_name=$request->input('company_name');
        $providerDetails->services_id=$request->input('service');
        $providerDetails->level=$request->input('level');
        $providerDetails->start_time=$start_time;
        $providerDetails->end_time=$end_time;
        $providerDetails->start_rest_time=$start_rest_time;
        $providerDetails->end_rest_time=$end_rest_time;
        $providerDetails->save();
        

        return redirect()->back()->with('msg','Provider Car has been added');

    }
    public function store2(Request $request)
    {
        $users = new User();
        $users-> name = $request->input('name');
        $users-> role_id = 6;
        $users-> status = 1;
        $users-> address1 = $request->input('address1');
        $users-> address2 =$request->input('address2');
        $users-> address3 = $request->input('address3');
        $users-> address4 = $request->input('address4');
        $users-> postcode = $request->input('postcode');
        $users-> states_id = $request->input('state');
        $users-> save();

        $start_time=Carbon::parse('08:30:00')->format('H:i');
        $end_time=Carbon::parse('17:30:00')->format('H:i');
        $start_rest_time=Carbon::parse('13:00:00')->format('H:i');
        $end_rest_time=Carbon::parse('13:00:00')->format('H:i');
        $providerDetails = new provider_details();
        $providerDetails->user_id = $users->id;
        $providerDetails->provider_id=2;
        $providerDetails->provider_type_id=$request->input('provider_type');
        $providerDetails->company_name=$request->input('company_name');
        $providerDetails->services_id=$request->input('service');
        $providerDetails->level=$request->input('level');
        $providerDetails->start_time=$start_time;
        $providerDetails->end_time=$end_time;
        $providerDetails->start_rest_time=$start_rest_time;
        $providerDetails->end_rest_time=$end_rest_time;
        $providerDetails->save();
        

        return redirect()->back()->with('msg','Provider Meeting Room has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {;
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
