@extends('layouts.app')
@section('content')
    <div class="container" >
        <div class="row">
            @if ($appointments->provider_id == 3)
            <div class="col-md-8 mb-3">
                <div class="card bg-white"> 
                    <div class="card-header bg-info">Booking Details For Car</div>
                    <div class="card-body">  
                             <h6 class="card-title text-black-50">Car Name</h6>
                            <h5 class="card-text">{{ $appointments->providerDetailsApp->users->name }}</h5>
                            <h6 class="card-title text-black-50">Car Model</h6>
                            <h5 class="card-text">{{ $appointments->providerDetailsApp->providerTypes->name }}</h5>
                            <h6 class="card-title text-black-50">Time</h6>
                            <h5 class="card-text">{{ \Carbon\Carbon::parse($appointments->start_time)->format('H:i')}}</h5>
                            <h6 class="card-title text-black-50">Date</h6>
                            <h5 class="card-text">{{ \Carbon\Carbon::parse($appointments->start_date)->format('d/m/Y') }}</h5>
                            <h6 class="card-title text-black-50">Remarks</h6>
                            <h5 class="card-text">{{ $appointments->remarks }}</h5>
                                @if ($appointments->status==1)
                                    <h6 class="card-title text-black-50">Remarks</h6>
                                    <h5 class="card-text">{{ $appointments->remarks }}</h5>
                                @endif 
                    </div>
                </div>
            </div>
            @endif 
            @if ($appointments->provider_id == 2)
            <div class="col-md-8 mb-3">
                <div class="card bg-white"> 
                    <div class="card-header bg-info">Booking Details For Meeting Room</div>
                    <div class="card-body"> 
                            <h6 class="card-title text-black-50">Meeting Room Name</h6>
                            <h5 class="card-text">{{ $appointments->providerDetailsApp->users->name }}</h5>
                            <h6 class="card-title text-black-50">Meeting Room Type</h6>
                            <h5 class="card-text">{{ $appointments->providerDetailsApp->providerTypes->name }}</h5>
                            <h6 class="card-title text-black-50">Time</h6>
                            <h5 class="card-text">{{ \Carbon\Carbon::parse($appointments->start_time)->format('H:i')}}</h5>
                            <h6 class="card-title text-black-50">Date</h6>
                            <h5 class="card-text">{{ \Carbon\Carbon::parse($appointments->start_date)->format('d/m/Y') }}</h5>
                            <h6 class="card-title text-black-50">Floor</h6>
                            <h5 class="card-text">
                                {{ $appointments->providerDetailsApp->level }}
                                </h5>
                                <h6 class="card-title text-black-50">Remarks</h6>
                            <h5 class="card-text">{{ $appointments->remarks }}</h5>
                                @if ($appointments->status==1)
                                    <h6 class="card-title text-black-50">Remarks</h6>
                                    <h5 class="card-text">{{ $appointments->remarks }}</h5>
                                @endif 
                    </div>
                </div>
            </div>
            @endif
            @if ($appointments->provider_id == 1)
            <div class="col-md-8 mb-3">
                <div class="card bg-white"> 
                    <div class="card-header bg-info">Booking Details for Clinic</div>
                    <div class="card-body"> 
                            <h6 class="card-title text-black-50">Provider's Name</h6>
                            <h5 class="card-text">{{ $appointments->appUser->name }}</h5>
                            <h6 class="card-title text-black-50">Time</h6>
                            <h5 class="card-text">{{ \Carbon\Carbon::parse($appointments->start_time)->format('H:i')}}</h5>
                            <h6 class="card-title text-black-50">Date</h6>
                            <h5 class="card-text">{{ \Carbon\Carbon::parse($appointments->start_date)->format('d/m/Y') }}</h5>
                            <h6 class="card-title text-black-50">Location</h6>
                            <h5 class="card-text">
                                @if($appointments->appUser->address1 != '')
                                {{ $appointments->appUser->address1 }},
                                @endif
                                @if($appointments->appUser->address2 != '')
                                {{ $appointments->appUser->address2 }},
                                @endif
                                @if($appointments->appUser->address3 != '')
                                {{ $appointments->appUser->address3 }},
                                @endif
                                @if($appointments->appUser->address4 != '')
                                {{ $appointments->appUser->address4 }},
                                @endif
                                @if($appointments->appUser->postcode != '')
                                {{ $appointments->appUser->postcode }},
                                @endif
                                @if($appointments->appUser->state != '')
                                {{ $appointments->appUser->state }},
                                @endif
                                </h5>
                            <h6 class="card-title text-black-50">Clinic's name</h6>
                            <h5 class="card-text">{{ $appointments->providerDetailsApp->company_name }}</h5>
                            <h6 class="card-title text-black-50">Status</h6>
                                @if($appointments->status==0)
                                    <h5 class="">Pending Approval</h5>
                                @elseif($appointments->status==1)
                                    <h5>Approved</h5>
                                @else
                                    <h5>Not Approved</h5>
                                @endif
                                @if ($appointments->status==1)
                                    <h6 class="card-title text-black-50">Remarks</h6>
                                    <h5 class="card-text">{{ $appointments->remarks }}</h5>
                                @endif 
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection