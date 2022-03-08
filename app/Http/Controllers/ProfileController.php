<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\state;
use App\Models\provider_details;
use App\Models\provider_type;
use App\Models\Services;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provider_types=provider_type::where('provider_id',1)->get();
        $states=state::all();
        $services=Services::where('provider_id',1)->get();
        return view('User.profile',compact('states','provider_types','services'));
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
        //
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
        return view('User.profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user_id=Auth::user()->id;
        $user = User::find($user_id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->cc_email=$request->cc_email;
        $user->address1=$request->address1;
        $user->address2=$request->address2;
        $user->address3=$request->address3;
        $user->address4=$request->address4;
        $user->postcode=$request->postcode;
        $user->states_id=$request->state;
        $user->phone_number=$request->phone_number;
   
        //image
        if($request->hasfile('image'))
        {
            $destination='uploads/profile/'.$user->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file=$request->file('image');
            $extensions=$file->getClientOriginalExtension();
            $filename=time().'.'. $extensions;
            $file->move('uploads/profile/',$filename);
            $user->image=$filename;
        }
        // $user->push();
        $user->save();
        if ($user->role_id == 1){
        $provider = provider_details::where('user_id',$user_id)->first();
        $provider->company_name=$request->company_name ?? null;
        $provider->provider_type_id=$request->provider_type ?? null;
        $provider->services_id=$request->service ?? null;
        $provider->level=$request->level ?? null;
        $provider->save();
    }
        return redirect()->back()->with('success', 'Profile Updated');
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

