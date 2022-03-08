<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\provider_details;
use Illuminate\Support\Facades\Auth;
class dashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	if(Auth::user()->role->name=='customer'){
    		return view('home');
    	}
        $appointments=Appointment::where('start_date',date('Y-m-d'))->where('status',0)->where('providerDetails_id',auth()->user()->id)->get();
    	return view('admin.doctor.index',compact('appointments'));
    }
}
