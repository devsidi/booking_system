<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\provider_details;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;

class BookingDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $appointments = Appointment::latest()->with(['providerDetailsApp.users' => function ($query) {
            $query->select('id','name');
        }])->where('user_id',auth()->user()->id)->get();
        return view('booking.bookingDetails',compact('appointments'));
    }
    public function BookingDetails($appointmentsId){
        $appointments=Appointment::with(['providerDetailsApp.users' => function ($query) {
            $query->select('id','name','address1','address2','address3','address4','postcode');
        }])->where('id',$appointmentsId)->first();
        $appointments_id=$appointmentsId;
        return view('booking.index',compact('appointments','appointments_id'));
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

    // user cancel booking 
    public function update(request $name,$id) 
    {     
        $appointmentsId = appointment::find($id); 
        $appointment = appointment::where('id',$appointmentsId['id'])->update(['status'=>2]); 

        $UserCancelEmailBooking=DB::table('appointments')
        ->join('users','users.id','=','appointments.user_id')
        ->join('provider_details','provider_details.id','=','appointments.providerDetails_id') 
        ->select('appointments.*','users.*')
        ->where('appointments.id',$appointmentsId['id'])
        ->first();   
        
        Mail::to($UserCancelEmailBooking->email)->send(new \App\Mail\UserCancelEmailBooking($UserCancelEmailBooking)); 
        return redirect()->back()->with('success', 'You cancel the booking request!');

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
