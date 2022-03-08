<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\provider_details;
use App\Models\state;
use App\Models\Services;
use App\Models\provider_type;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class listAllDoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors=User::where('role_id',1)->get();
        return view('admin.doctor.listAllDoctor',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states=state::all();
        $services=Services::where('provider_id',1)->get();
        $provider_types=provider_type::where('provider_id',1)->get();
        return view('admin.doctor.createDoctor',compact('states','provider_types','services'));
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
        $users-> email = $request->input('email');
        $users-> password = Hash::make($request->input('password')); 
        $users-> name = $request->input('name');
        $users-> role_id = 1;
        $users-> address1 = $request->input('add1');
        $users-> address2 =$request->input('add2');
        $users-> address3 = $request->input('add3');
        $users-> address4 = $request->input('add4');
        $users-> postcode = $request->input('postcode');
        $users-> states_id = $request->input('state');
        $users-> save();

        $start_time=Carbon::parse('09:00:00')->format('H:i');
        $end_time=Carbon::parse('18:00:00')->format('H:i');
        $start_rest_time=Carbon::parse('13:00:00')->format('H:i');
        $end_rest_time=Carbon::parse('14:00:00')->format('H:i');
        $providerDetails = new provider_details();
        $providerDetails->user_id = $users->id;
        $providerDetails->provider_id=1;
        $providerDetails->provider_type_id=$request->input('provider_type');
        $providerDetails->company_name=$request->input('company_name');
        $providerDetails->services_id=$request->input('service');
        $providerDetails->level=$request->input('level');
        $providerDetails->start_time=$start_time;
        $providerDetails->end_time=$end_time;
        $providerDetails->start_rest_time=$start_rest_time;
        $providerDetails->end_rest_time=$end_rest_time;
        $providerDetails->save();
        

        return redirect()->back()->with('msg','Doctor has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::find($id);
        return view('admin.provider.delete',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users=User::find($id);
        $states=state::all();
        $services=Services::where('provider_id',1)->get();
        $provider_types=provider_type::where('provider_id',1)->get();
        return view('admin.provider.edit',compact('users','states','services','provider_types'));
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
        $user_id=$id;
        $user = User::find($user_id);
        $user->name=$request->name;
        $user->address1=$request->address1;
        $user->address2=$request->address2;
        $user->address3=$request->address3;
        $user->address4=$request->address4;
        $user->postcode=$request->postcode;
        $user->states_id=$request->state;
        $user->save();

        $provider = provider_details::where('user_id',$user_id)->first();
        $provider->company_name=$request->company_name ?? null;
        $provider->provider_type_id=$request->provider_type ?? null;
        $provider->services_id=$request->service ?? null;
        $provider->level=$request->level ?? null;
        $provider->start_time=$request->Startime ?? null;
        $provider->end_time=$request->EndTime ?? null;
        $provider->start_rest_time=$request->startRestTime ?? null;
        $provider->end_rest_time=$request->endRestTime ?? null;
        $provider->slot_duration=$request->TimeSlots ?? null;
        $provider->save();
        return redirect()->back()->with('msg', 'doctor Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users=User::find($id);
        $users->delete();
        return redirect()->route('alldoctor.index')->with('msg','doctor deleted successfully');
    }
}
