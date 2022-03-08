<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Time;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TodayRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms=Appointment::where('provider_id',2)->with(['providerDetailsApp.users' => function ($query) {
            $query->select('id','name');
        }])
        ->orderby ('created_at','DESC')
        ->get();
        return view('admin.provider.RoomToday',compact('rooms'));
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
        // appointmnet status
        // 0 - pending approval 
        // 1- Approved
        // 2 - cancel
        $rm_id=appointment::find($id);
        $appointment=appointment::where('id',$rm_id['id'])->update(['status'=>1]);
        $user=Appointment::where('id',$rm_id['id'])->select('user_id')->first();
        $user_email=user::where('id',$user['user_id'])->first();
        
        Mail::to($user_email['email'])->send(new \App\Mail\UserAppBooking([]));
        return redirect()->back()->with('msg','The request is approved, email notification has been sent to the requestor.');
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
        $remark=$request->admin_remarks; 
        $admin=$request->admin;
        $comment = $remark. '. ' .$admin;
        $rm_id=$request->rm_id; 
        $rm_id=appointment::find($rm_id);
        $appointment=appointment::where('id',$rm_id['id'])->update(['status'=>2,'remark_approval'=>$comment]);
        $user=Appointment::where('id',$rm_id['id'])->select('user_id')->first(); 
        $user_email=user::where('id',$user['user_id'])->first(); 
        $UserCancelBooking=DB::table('appointments')
        ->join('users','users.id','=','appointments.user_id')
        ->join('provider_details','provider_details.id','=','appointments.providerDetails_id') 
        ->select('appointments.*','users.*','provider_details.*')
        ->where('appointments.id',$rm_id['id'])
        ->first();  

        Mail::to($UserCancelBooking->email)->cc($UserCancelBooking->cc_email)->send(new \App\Mail\UserCancelBooking($UserCancelBooking));
        return redirect()->action([TodayRoomController::class, 'index'])->with('msg-cancel','The room request is cancelled. Email notification has been sent to the requestor.'); 
    }

    public function updateapp(Request $request)
    {
        $remark=$request->admin_remarks; 
        $admin=$request->admin;
        $comment = $remark. '. ' .$admin;
        $rm_id=$request->rm_id; 
        $rm_id=appointment::find($rm_id);
        $appointment=appointment::where('id',$rm_id['id'])->update(['status'=>1,'remark_approval'=>$comment]);
        $user=Appointment::where('id',$rm_id['id'])->select('user_id')->first(); 
        $user_email=user::where('id',$user['user_id'])->first(); 
        $AppRoomBooking=DB::table('appointments')
        ->join('users','users.id','=','appointments.user_id')
        ->join('provider_details','provider_details.id','=','appointments.providerDetails_id') 
        ->select('appointments.*','users.*','provider_details.*')
        ->where('appointments.id',$rm_id['id'])
        ->first();  

        Mail::to($AppRoomBooking->email)->cc($AppRoomBooking->cc_email)->send(new \App\Mail\AppRoomBooking($AppRoomBooking));
        return redirect()->action([TodayRoomController::class, 'index'])->with('msg-cancel','The room request is approved. Email notification has been sent to the requestor.'); 
    }

    public function admincancel(Request $request,$id)
    {
        $rooms=appointment::find($id);
        return view('admin.provider.cancelroomToday',compact('rooms'));
    }

    public function adminapp(Request $request,$id)
    {
        $rooms=appointment::find($id);
        return view('admin.provider.approomToday',compact('rooms'));
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
