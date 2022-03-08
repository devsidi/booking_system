<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\doctor;
use App\Models\User;
use App\Models\Time;
use App\Models\Appointment;
use DateTime;
use Carbon\CarbonPeriod;
use App\Mail\UserBooking;
use App\Mail\doctorEmail;
use App\Mail\adminEmail;
use App\Models\provider;
use App\Models\provider_details;
use App\Models\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Timer\Duration;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $reserves=provider_details::all();
        $providers=provider::all() ->where('status',1);
        return view('reserve.index',compact('reserves','providers'));
    }
    public function indexadmin()
    { 
        $reserves=provider_details::all();
        $providers=provider::all() ->where('status',1);
        return view('reserve.index',compact('reserves','providers'));
    }
    public function fetch(Request $request){
        $services = Services::where('provider_id',$request->provider)->get();
        return response()->json($services);
    }
    public function fetchCompany(Request $request){
        $company =provider_details::where('services_id',$request->service)->get();
        return response()->json($company);
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
        $request->validate(['dateText'=>'required']);
        $request->validate(['time'=>'required']); 
        
        $date=Carbon::parse($request->dateText)->format('Y-m-d');
        $date2=$request->dateText2;
        if($request->dateText2 != null){
            $date2=Carbon::parse($request->dateText2)->format('Y-m-d');
        }else{
            $date2 = null;
        }
        $time=Carbon::parse($request->time)->format('H:i:s'); 
        $time2=$request->time2;
        if($request->time2 != null){
            $time2=Carbon::parse($request->time2)->format('H:i:s');
        }else{
            $time2 = null;
        }
        $remarks=$request->reasons;
        if ($request->time != $request->time2){
        Appointment::create([
            'user_id'=>auth()->user()->id,
            'provider_id'=>$request->provider_id,
            'providerDetails_id'=>$request->providerDetails_id,
            'start_time'=>$time,
            'end_time'=>$time2,
            'duration'=>$request->quantity,
            'start_date'=>$date,
            'end_date'=>$date2,
            'status'=>0,
            'remarks'=>$remarks,
        ]);
        $userBooking=[
            'name'=>auth()->user()->name,
            'time'=>$time,
            'date'=>Carbon::parse($date)->format('d/m/Y'),
            'providerName'=>request()->get('providerName'),
            'company_name'=>request()->get('company_name'),
            'Add1'=>request()->get('Add1'),
            'Add2'=>request()->get('Add2'),
            'Add3'=>request()->get('Add3'),
            'Add4'=>request()->get('Add4'),
            'Postcode'=>request()->get('Postcode'),
            'State'=>request()->get('State')
            
        ];

        $appointment=Appointment::all();
        
        $doctorEmail=[
            'name'=>auth()->user()->name,
            'time'=>$time,
            'date'=>Carbon::parse($date)->format('d/m/Y'),
            'providerName'=>request()->get('providerName'),
            'doctor_email'=>request()->get('doc_email'),
            'company_name'=>request()->get('company_name'),
            'Add1'=>request()->get('Add1'),
            'Add2'=>request()->get('Add2'),
            'Add3'=>request()->get('Add3'),
            'Add4'=>request()->get('Add4'),
            'Postcode'=>request()->get('Postcode'),
            'State'=>request()->get('State')
        ];
        
        Mail::to(request()->get('doc_email') )->send(new \App\Mail\doctorEmail($doctorEmail));

        Mail::to(auth()->user()->email)->send(new \App\Mail\UserBooking($userBooking));
        return redirect()->back()->with('msg','Your appointment was booked');
        
    }else{
        return redirect()->back()->with('errmsg','Start time cannot be the same as End time');
    }
        
    }
    public function carBooking(Request $request){
        $date=Carbon::parse($request->datepicker3)->format('Y-m-d');
        $time=Carbon::parse($request->time3)->format('H:i:s'); 
        $duration=$request->quantity;
        $remarks=$request->reasons;
        Appointment::create([
            'user_id'=>auth()->user()->id,
            'provider_id'=>$request->provider_id,
            'providerDetails_id'=>$request->providerDetails_id,
            'start_time'=>$time,
            'end_time'=>null,
            'duration'=>$request->quantity,
            'start_date'=>$date, 
            'status'=>0,
            'remarks'=>$remarks,
        ]);
        $userBooking=[
            'name'=>auth()->user()->name,
            'cc_email'=>auth()->user()->cc_email,
            'time'=>$time,
            'date'=>Carbon::parse($date)->format('d/m/Y'),
            'providerName'=>request()->get('providerName'),
            'reason'=>request()->get('reasons'),
            'company_name'=>request()->get('company_name'),
            'Add1'=>request()->get('Add1'),
            'Add2'=>request()->get('Add2'),
            'Add3'=>request()->get('Add3'),
            'Add4'=>request()->get('Add4'),
            'Postcode'=>request()->get('Postcode'),
            'State'=>request()->get('State')
            
        ];  
        $admin_email = User::where('role_id',2)->select('email')->first(); 
        $adminEmail=[
            'name'=>auth()->user()->name,
            'time'=>$time,
            'date'=>Carbon::parse($date)->format('d/m/Y'),
            'providerName'=>request()->get('providerName'), 
            'reason'=>request()->get('reasons'), 
            'providerName'=>request()->get('providerName'), 
            'quantity'=>request()->get('quantity')  
        ]; 
        Mail::to($admin_email['email'])->send(new \App\Mail\adminEmail($adminEmail)); 
        
        Mail::to(auth()->user()->email)->cc(auth()->user()->cc_email)->send(new \App\Mail\UserBooking($userBooking));
        return redirect()->back()->with('msg','Booking request has been sent to Admin Department to review.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($providerId,$providerDetailsId)
    {
        $appointments=Appointment::where('provider_id',$providerId)->get();
        $providers=provider_details::where('id',$providerDetailsId)->where('provider_id',$providerId)->first();
        $provider_id=$providerId;
        $providerDetails_id=$providerDetailsId;

        return view('reserve.appointment',compact('providers','provider_id','appointments','providerDetails_id'));
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
    public function update(Request $request, $id)
    {
        //
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
    public function search(Request $request){ 
            $providers=$request->input('provider');
            $providers=provider::all()->where('status',1); 
            $reserves=User::join("provider_details","provider_details.user_id","=","users.id")
            ->where('provider_details.status','=','0')
            ->where('users.status',1)
            ->where('provider_details.provider_id',$request->input('provider'))
            ->get(); 
            return view('reserve.search',compact('reserves','providers'));
        }

        public function getTimeCar(Request $request) { 

            $providers=provider_details::where('id',$request->providerDetails_id)->first();
            $appointment=Appointment::where('providerDetails_id',$request->providerDetails_id)
            ->where('start_date',$request->input('datepicker')) 
            ->where('status','=',1) 
            ->first(); 
            if($appointment == null){
                
            //start_time from appointment 
            $sometimeOut=$providers->slot_duration;
            $start=$providers->start_time;
            $startRest=$providers->start_rest_time;
            $endRest=$providers->end_rest_time; 
            $end=$providers->end_time; 

            //sampai jam berapa dia guna 
            $data2=[];
            $timeSlot = $this->getTimeSlot($sometimeOut, $start, $startRest);
            $timeSlot2 = $this->getTimeSlot2($sometimeOut, $endRest, $end);
            $data1=[];
            $data3=[];
            foreach($timeSlot as $timeSlots){
                $arr=array($timeSlots);
                array_push($data1,$arr); 
            }

            foreach($timeSlot2 as $timeSlot2s){
                $arr3=array($timeSlot2s);
                array_push($data3,$arr3);
            } 
                $test1 = array_column($data1, '0');
                $test3 = array_column($data3, '0');
                $result=array_merge($test1,$test3); 

            return response()->json($result);
            
            }else{
            //start_time from appointment
            $start2=$appointment->start_time; 
            $sometimeOut=$providers->slot_duration;
            $start=$providers->start_time;
            $startRest=$providers->start_rest_time;
            $endRest=$providers->end_rest_time; 
            $end=$providers->end_time;
            $duration=$appointment->duration;
            $masa = date("Y-m-d H:i:s", strtotime($start2) + $duration * 60 * 60); 
            $data2=[];
            $timeSlot = $this->getTimeSlot($sometimeOut, $start, $startRest);
            $timeSlot2 = $this->getTimeSlot2($sometimeOut, $endRest, $end);
            $timeSlot3= $this->getTimeSlotCar($sometimeOut,$start2,$masa); 
            $data1=[];
            $data3=[];

            //morning slot
            foreach($timeSlot as $timeSlots){ 
                array_push($data1,$timeSlots); 
            } 
            //evening slot
            foreach($timeSlot2 as $timeSlot2s){
                array_push($data3,$timeSlot2s);
            } 
            //disable slot
            foreach($timeSlot3 as $timeSlot3s){
                array_push($data2,$timeSlot3s); 
            } 
                $test1 = array_column($data1, '0');
                $test2 = array_column($data2, '0');
                $test3 = array_column($data3, '0');
                $result=array_merge($data1,$data3); 
                $combined2 = array_diff($result,$data2); 
            return response()->json($combined2);
            }
            
        }
        public function getTime(Request $request) 
        { 
            $providers=provider_details::where('id',$request->providerDetails_id)->first(); 
            $sometimeOut=$providers->slot_duration;
            $start=$providers->start_time;
            $startRest=$providers->start_rest_time;
            $endRest=$providers->end_rest_time; 
            $end=$providers->end_time; 
            $time = Appointment::select('start_time','end_time') 
            ->when($request->datepicker !=null,function($query) use ($request){
                $query->where('provider_id',$request->provider_id)
                        ->where('providerDetails_id',$request->providerDetails_id)
                        ->where('status','!=',2)
                        ->whereDate('start_date',$request->datepicker);
            })
            ->when($request->datepicker2 !=null,function($query) use ($request){
                $query->where('provider_id',$request->provider_id)
                        ->where('providerDetails_id',$request->providerDetails_id) 
                        ->whereDate('end_date',$request->datepicker2);
            })
            ->get(); 
            
            $data2=[];
            $timeSlot = $this->getTimeSlot($sometimeOut, $start, $startRest);
            $timeSlot2 = $this->getTimeSlot2($sometimeOut, $endRest, $end);
            $data1=[];
            $data3=[];
            foreach($timeSlot as $timeSlots){
                $arr=array($timeSlots);
                array_push($data1,$arr); 
            }

            foreach($timeSlot2 as $timeSlot2s){
                $arr3=array($timeSlot2s);
                array_push($data3,$arr3);
            }
            foreach($time as $times){
                $arr2=array(Carbon::parse($times->start_time)->format('H:i')); 
                array_push($data2,$arr2); 
            }
                $test1 = array_column($data1, '0');
                $test2 = array_column($data2, '0');
                $test3 = array_column($data3, '0');
                $result=array_merge($test1,$test3); 
                $combined = array_diff($result,$test2); 
            return response()->json($combined);
        }

        private function getTimeSlot($sometimeOut, $start, $startRest)
            {
                $start = new DateTime($start);
                $end = new DateTime($startRest);
                $BeginTimeStemp = $start->format('H:i'); // Get time Format in Hour and minutes
                $lastTimeStemp = $end->format('H:i');
                $i=0;
                while(strtotime($BeginTimeStemp) <= strtotime($lastTimeStemp)){
                    $start = $BeginTimeStemp;
                    $end = date('H:i',strtotime('+'.$sometimeOut.' minutes',strtotime($BeginTimeStemp)));
                    $BeginTimeStemp = date('H:i',strtotime('+'.$sometimeOut.' minutes',strtotime($BeginTimeStemp)));
                    $i++;
                    if(strtotime($BeginTimeStemp) <= strtotime($lastTimeStemp)){
                                           
                            $time[$i]= $start; 
                    
                    }
                }
                return $time;
            }
        private function getTimeSlot2($sometimeOut, $endRest, $end)
            {
                $endRest = new DateTime($endRest);
                $end = new DateTime($end);
                $BeginTimeStemp = $endRest->format('H:i'); // Get time Format in Hour and minutes
                $lastTimeStemp = $end->format('H:i');
                $i=0;
                while(strtotime($BeginTimeStemp) <= strtotime($lastTimeStemp)){
                    $endRest = $BeginTimeStemp;
                    $end = date('H:i',strtotime('+'.$sometimeOut.' minutes',strtotime($BeginTimeStemp)));
                    $BeginTimeStemp = date('H:i',strtotime('+'.$sometimeOut.' minutes',strtotime($BeginTimeStemp)));
                    $i++;
                    if(strtotime($BeginTimeStemp) <= strtotime($lastTimeStemp)){
                        $time[$i] = $endRest; 
                    }
                }
                return $time;
            }
        private function getTimeSlotCar($sometimeOut, $startSlot, $endSlot)
            {
                $startSlot = new DateTime($startSlot);
                $endSlot = new DateTime($endSlot);
                $BeginTimeStemp = $startSlot->format('H:i'); // Get time Format in Hour and minutes
                $lastTimeStemp = $endSlot->format('H:i');
                $i=0;
                while(strtotime($BeginTimeStemp) <= strtotime($lastTimeStemp)){
                    $startSlot = $BeginTimeStemp;
                    $endSlot = date('H:i',strtotime('+'.$sometimeOut.' minutes',strtotime($BeginTimeStemp)));
                    $BeginTimeStemp = date('H:i',strtotime('+'.$sometimeOut.' minutes',strtotime($BeginTimeStemp)));
                    $i++;
                    if(strtotime($BeginTimeStemp) <= strtotime($lastTimeStemp)){
                        $time[$i] = $startSlot; 
                    }
                }
                return $time;
            }
}
