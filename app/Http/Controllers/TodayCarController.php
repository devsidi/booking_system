<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\provider_details;
use Illuminate\Http\Request;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Time;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TodayCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars=Appointment::where('provider_id',3)->with(['providerDetailsApp.users' => function ($query) {
            $query->select('id','name');
        }])
        ->orderby ('created_at','DESC')
        ->get();
        return view('admin.provider.carToday',compact('cars'));
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
    // approve the request
    public function edit($id)
    {
        // appointmnet status
        // 0 - pending approval 
        // 1- Approved
        // 2 - cancel 
        $car_id=appointment::find($id); 
        $appointment=appointment::where('id',$car_id['id'])->update(['status'=>1]); 
        $UserAppBooking=DB::table('appointments')
        ->join('users','users.id','=','appointments.user_id')
        ->join('provider_details','provider_details.id','=','appointments.providerDetails_id') 
        ->select('appointments.*','users.*','provider_details.*')
        ->where('appointments.id',$car_id['id'])
        ->first(); 

        Mail::to($UserAppBooking->email)->send(new \App\Mail\UserAppBooking($UserAppBooking));
        return redirect()->back()->with('msg','The request is approved, email notification has been sent to the requestor.');
    } 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // cancel function
    public function updatecancel(Request $request)
    {
        $remark=$request->admin_remarks; 
        $admin=$request->admin;
        $comment = $remark. '. ' .$admin;
        $car_id=$request->car_id;  
        $car_id=appointment::find($car_id); 
        $appointment=appointment::where('id',$car_id['id'])->update(['status'=>2,'remark_approval'=>$comment]); 
        $UserCancelBooking=DB::table('appointments')
        ->join('users','users.id','=','appointments.user_id')
        ->join('provider_details','provider_details.id','=','appointments.providerDetails_id') 
        ->select('appointments.*','users.*','provider_details.*')
        ->where('appointments.id',$car_id['id'])
        ->first(); 

        Mail::to($UserCancelBooking->email)->cc($UserCancelBooking->cc_email)->send(new \App\Mail\UserCancelBooking($UserCancelBooking)); 
        return redirect()->action([TodayCarController::class, 'index'])->with('msg-cancel','The car request is cancelled. Email notification has been sent to the requestor.');
    }

    public function updateapp(Request $request)
    {
        $remark=$request->admin_remarks; 
        $admin=$request->admin;
        $comment = $remark. '. ' .$admin;
        $car_id=$request->car_id;  
        $car_id=appointment::find($car_id); 
        $appointment=appointment::where('id',$car_id['id'])->update(['status'=>1,'remark_approval'=>$comment]); 
        $AdminappBooking=DB::table('appointments')
        ->join('users','users.id','=','appointments.user_id')
        ->join('provider_details','provider_details.id','=','appointments.providerDetails_id') 
        ->select('appointments.*','users.*','provider_details.*')
        ->where('appointments.id',$car_id['id'])
        ->first(); 

        Mail::to($AdminappBooking->email)->cc($AdminappBooking->cc_email)->send(new \App\Mail\AdminAppBooking($AdminappBooking)); 
        return redirect()->action([TodayCarController::class, 'index'])->with('msg-cancel','The car request is approved. Email notification has been sent to the requestor.');
    }

    public function admincancel(Request $request,$id)
    {
        $cars=appointment::find($id);
        return view('admin.provider.cancelcarToday',compact('cars'));
    }

    public function adminapp(Request $request,$id)
    {
        $cars=appointment::find($id);
        return view('admin.provider.appcarToday',compact('cars'));
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
