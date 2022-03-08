@extends('layouts.app')
@section('content')
    <div class="container">
      @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
      @endif
        <h2>History</h2>
      <form action="{{ url('/booking-cancel') }}" method="POST">
        @csrf
        @forelse ($appointments as $appointment)
        <input type="hidden" name="appointmentId" id="appointmentId" value="{{ $appointment->id }}">
        <input type="hidden" name="start_time" value="{{ $appointment->start_time }}">
        <input type="hidden" name="start_date" value="{{ $appointment->start_date }}">
        <input type="hidden" name="Add1" value="{{ $appointment->appUser->address1 }}">
        <input type="hidden" name="Add2" value="{{ $appointment->appUser->address2 }}">
        <input type="hidden" name="Add3" value="{{ $appointment->appUser->address3 }}">
        <input type="hidden" name="Add4" value="{{ $appointment->appUser->address4 }}">
        <input type="hidden" name="docPostcode" value="{{ $appointment->appUser->postcode }}">
        <input type="hidden" name="docState" value="{{ $appointment->appUser->state }}">
        <input type="hidden" name="doctorName" value="{{ $appointment->appUser->name }}">
        <input type="hidden" name="doc_email" value="{{ $appointment->appUser->email }}">
        <input type="hidden" name="company_name" value="{{ $appointment->providerDetailsApp->company_name }}">
          <ul class="list-group">
            <b><li class="list-group-item mb-2" style="font-size:18px;font-family: Arial, Helvetica, sans-serif;">{{ $appointment->providerDetailsApp->users->name }} </b>
              <p class="text-black-50" style="font-size: 15px">{{ \Carbon\Carbon::parse($appointment->start_date)->format('d/m/Y')}} <a href="{{ url('/BookingDetails',[$appointment->id]) }}" class="fa fa-angle-right" style="float: right;font-size:36px" ></a></p>
              <h6>@if($appointment->status==0)
                  Pending Approval
                @elseif($appointment->status==1)
                  <P style="color:green;">Request Approved.</p>
                @else
                  <P style="color:red;">Booking request Cancelled.</p>
                @endif
              </h6> 
              @if ($appointment->status==0)
                <button class="btn btn-warning" type="submit"><a href="{{ url('/booking-user-cancel',[$appointment->id]) }}">Cancel Request</a></button>
              @endif
            </li> 
          </ul> 
        @empty
        <h3>You have no any appointments</h3>
        @endforelse
      </form>
    </div>
@endsection