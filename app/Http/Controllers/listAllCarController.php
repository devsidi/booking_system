<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\provider_details;
use App\Models\User;
use App\Models\state;
use App\Models\Services;
use App\Models\provider_type;
use Illuminate\Http\Request;

class listAllCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars=User::where('role_id',5)->where('status',1)->get();
        return view("admin.provider.carListing",compact('cars'));
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
        //
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
        $services=Services::where('provider_id',3)->get();
        $provider_types=provider_type::where('provider_id',3)->get();
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
        return redirect()->back()->with('msg', 'Car Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users=User::where('id',$id)->update(['status'=>0]);
        // $users->delete();
        // $users->update(['status'=>0]);
        return redirect()->route('allCar.index')->with('msg','Car deleted successfully');
    }
}
