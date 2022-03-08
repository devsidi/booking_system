<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CustomerListTodayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments=Appointment::where('start_date',date('Y-m-d'))->where('providerDetails_id',auth()->user()->id)->get();
        return view('admin.doctor.today',compact('appointments'));
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
        $user_id=$request->input('user_id');
        $times=$request->input('start_time');
        $dates=$request->input('start_date');
        $appointments=Appointment::where('user_id',$user_id)->where('start_time',$times)->where('start_date',$dates)->first();
        $appointments->status=1;
        $appointments->update();
        return redirect()->back()->with('msg','This patient has attended the appointment');
    }
    public function cancelBooking(Request $request)
    {
        
        $user_id=$request->input('user_id');
        $times=$request->input('start_time');
        $dates=$request->input('start_date');
        $appointments=Appointment::where('user_id',$user_id)->where('start_time',$times)->where('start_date',$dates)->first();
        $appointments->status=2;
        $appointments->update();
        $date=Carbon::parse($request->start_date)->format('Y-m-d');
        $time=Carbon::parse($request->start_time)->format('H:i:s');
        return redirect()->back()->with('msg','You have cancel this appointment');
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
