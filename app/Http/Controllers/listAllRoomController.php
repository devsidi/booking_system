<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\state;
use App\Models\Services;
use App\Models\provider_type;
use App\Models\provider_details;
class listAllRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms=User::where('role_id',6)->where('status',1)->get();
        return view('admin.provider.RoomListing',compact('rooms'));
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
        $services=Services::where('provider_id',2)->get();
        $provider_types=provider_type::where('provider_id',2)->get();
        return view('admin.provider.edit',compact('users','states','services','provider_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
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

        // $reserves->update();
        return redirect()->back()->with('msg', 'Meeting Room Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users=User::find($id)->update(['status'=>0]);
        // $users->delete();
        return redirect()->route('allMeetingRoom.index')->with('msg','Meeting room deleted successfully');
    }
}
