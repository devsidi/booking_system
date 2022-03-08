@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
        @endforeach
        @if (Session::has('msg'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('msg') }}
            </div>
        @endif
        @if(Session::has('errmsg'))
            <div class="alert alert-danger">
                {{Session::get('errmsg')}}
            </div>
        @endif
        @if ($providers->provider_id=='1')
            <form action="{{ route('userAppointment') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-3 mb-2">
                        <div class="card">
                            <div class="card-body text-center   ">
                                <h4 class="text-center">
                                    Provider Information
                                </h4>
                                    <img src="/img/dr.png" style="background-size: cover; border-radius: 999px; height: 120px; width: 120px; margin: 0 auto 20px auto" class="card-img-top" class="img-fluid rounded" class="" alt="...">
                                <br>
                                <p class="lead">
                                    Name : {{ ucfirst($providers->myProvider->name) }}
                                </p>
                                <p class="lead">  
                                    Level : {{ $providers->level}}
                                </p>
                                <p class="lead">
                                    Speciality : {{ $providers->providerTypes->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 mb-2">
                        <div class="card" >
                            <div class="card-body">
                                <h4 class="text-center">
                                    Book your Appointment 
                                </h4>
                                    <input type='date' id="datepicker1" class="form-control mb-2" name="dateText" placeholder="Select date">
                                @foreach ($appointments as $appointment )
                                    <input type="hidden" name="end_time" value="{{ $appointment->start_time }}"> 
                                @endforeach
                                @php
                                    $test='<input type="text" id="selected" name="selected" value="">'; 
                                @endphp
                                <select class="form-control mb-2" name="time" id="time">
                                </select>
                                @if ($providers->provider_id=='3' || $providers->provider_id=='2')
                                    <label for="return_time">Return time</label>
                                    <select class="form-control mb-2" name="time2" id="time2">
                                    </select> 
                                @endif
                                <input type="hidden" id="provider_id" name="provider_id" value="{{ $provider_id }}"> 
                                <input type="hidden" id="providerDetails_id" name="providerDetails_id" value="{{ $providerDetails_id }}"> 
                                <input type="hidden" name="providerName" value="{{ $providers->myProvider->name }}"> 
                                <input type="hidden" name="company_name" value="{{ $providers->company_name }}"> 
                                <input type="hidden" name="Add1" value="{{ $providers->myProvider->address1 }}"> 
                                <input type="hidden" name="Add2" value="{{ $providers->myProvider->address2 }}"> 
                                <input type="hidden" name="Add3" value="{{ $providers->myProvider->address3 }}"> 
                                <input type="hidden" name="Add4" value="{{ $providers->myProvider->address4}}"> 
                                <input type="hidden" name="Postcode" value="{{ $providers->myProvider->postcode }}"> 
                                <input type="hidden" name="State" value="{{ $providers->myProvider->state }}"> 
                                <input type="hidden" name="start_time" value="{{ $providers->start_time }}"> 
                                <input type="hidden" name="end_time" value="{{ $providers->end_time }}"> 
                                <input type="hidden" name="doc_email" value="{{ $providers->myProvider->email }}">
                                <textarea style="width: 100%;min-height: 75px" id="remarks" name="reasons" placeholder="Remarks" required></textarea>
                                @if (Auth::check())
                                    <button type="submit" class="btn btn-success btn-lg main-blink">Proceed</button> 
                                @else
                                    <p>Please login or register to make an appointment</p>
                                    <a href="{{ route('register') }}">Register</a><br>
                                    <a href="{{ route('login') }}">Login</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>
        @endif
        @if ($providers->provider_id=='3')
        <div id="loading"></div>
            <form action="{{ route('carBooking') }}" method="post" id="booking">
                @csrf
                <div class="row">
                    <div class="col-lg-3 mb-2">
                        <div class="card">
                            <div class="card-body text-center   ">
                                <h4 class="text-center">
                                    Service Information
                                </h4>
                                @if ($providers->provider_id=='2')
                                    <img src="/img/meeting.png" style="background-size: cover; border-radius: 999px; height: 120px; width: 120px; margin: 0 auto 20px auto" class="card-img-top" class="img-fluid rounded" class="" alt="...">
                                @else
                                    <img src="/img/car.png" style="background-size: cover; border-radius: 999px; height: 120px; width: 120px; margin: 0 auto 20px auto" class="card-img-top" class="img-fluid rounded" class="" alt="...">
                                @endif
                                <br>
                                <p class="lead">
                                    Car Name : {{ ucfirst($providers->myProvider->name) }}
                                </p>
                                <p class="lead">  
                                    Seater : {{ $providers->level}}
                                </p>
                                <p class="lead">
                                    Car Model : {{ $providers->providerTypes->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 mb-2">
                        <div class="card" >
                            <div class="card-body">
                                <h4 class="text-center">
                                Book For Company Car
                                </h4>
                                    <input type='date' id="datepicker3" class="form-control mb-2" name="datepicker3" placeholder="Select date">
                                @foreach ($appointments as $appointment )
                                    <input type="hidden" name="end_time" id="end_time" value="{{ $appointment->start_time }}"> 
                                @endforeach
                                @php
                                    $test='<input type="text" id="selected" name="selected" value="">';  
                                @endphp 
                                <select class="form-control mb-2" name="time3" id="time3">
                                </select>
                                <div class="comment mb-2">
                                    <select style="width: 100%;min-height: 15px" name="quantity" id="quantity" class="form-control" required>
                                        <option value="">Please select duration -Hours</option>
                                        <option value="1">1 hours</option>
                                        <option value="2">2 hours</option>
                                        <option value="3">3 hours</option>
                                        <option value="4">4 hours</option>
                                        <option value="5">5 hours</option>
                                        <option value="6">6 hours</option>
                                        <option value="7">7 hours</option>
                                        <option value="8">8 hours</option>
                                        <option value="5">Book Half Day</option>
                                        <option value="9">Book Full day</option>
                                      </select> 
                                    {{-- <input type="number" id="quantity" style="width: 100%;min-height: 15px" name="quantity" min="1" max="9" placeholder="Hours"> --}}
                                </div> 
                                <input type="hidden" id="provider_id" name="provider_id" value="{{ $provider_id }}"> 
                                <input type="hidden" id="providerDetails_id" name="providerDetails_id" value="{{ $providerDetails_id }}"> 
                                <input type="hidden" name="providerName" value="{{ $providers->myProvider->name }}"> 
                                <input type="hidden" name="company_name" value="{{ $providers->company_name }}"> 
                                <input type="hidden" name="Add1" value="{{ $providers->myProvider->address1 }}"> 
                                <input type="hidden" name="Add2" value="{{ $providers->myProvider->address2 }}"> 
                                <input type="hidden" name="Add3" value="{{ $providers->myProvider->address3 }}"> 
                                <input type="hidden" name="Add4" value="{{ $providers->myProvider->address4}}"> 
                                <input type="hidden" name="Postcode" value="{{ $providers->myProvider->postcode }}"> 
                                <input type="hidden" name="State" value="{{ $providers->myProvider->state }}"> 
                                <input type="hidden" name="start_time" value="{{ $providers->start_time }}"> 
                                <input type="hidden" name="end_time" value="{{ $providers->end_time }}"> 
                                <input type="hidden" name="doc_email" value="{{ $providers->myProvider->email }}"> 
                                <div class="comment">
                                    <textarea class="textinput" style="width: 100%;min-height: 75px" id="remarks" name="reasons" placeholder="Remarks" required></textarea>
                                </div>
                                @if (Auth::check())
                                    <button type="submit" class="btn btn-success btn-lg main-blink"> 
                                        <i class="czi-user mr-2 ml-n1"></i>
                                        <span class="btn-txt">{{ __('Proceed') }}</span></button>
                                    <div style="margin-top:20px;">
                                    <p>Notes :</p> 
                                    <li>Please submit booking 3 days earlier. <b><u>For emergency use case to case basis</u></b>.</li>
                                    <li>Please ensure vehicle keys & cards are returned.</li>
                                    <li>Please ensure the cleanliness of the vehicle.</li>
                                    <li>Staff is required to take pictures before taking the car and after sending back the car. <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Email to Admin department for record purposed.</li>
                                    <li>If an accident occurs, please report to the admin team.</li>
                                    </div>
                                @else
                                    <p>Please login or register to make booking</p>
                                    <a href="{{ route('register') }}">Register</a><br>
                                    <a href="{{ route('login') }}">Login</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>
        @endif
        @if ($providers->provider_id=='2')
            <form action="{{ route('carBooking') }}" method="post" id="booking">
                @csrf
                <div class="row">
                    <div class="col-lg-3 mb-2">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 class="text-center">
                                    Service Information
                                </h4>
                                @if ($providers->provider_id=='2')
                                    <img src="/img/meeting.png" style="background-size: cover; border-radius: 999px; height: 120px; width: 120px; margin: 0 auto 20px auto" class="card-img-top" class="img-fluid rounded" class="" alt="...">
                                @else
                                    <img src="/img/car.png" style="background-size: cover; border-radius: 999px; height: 120px; width: 120px; margin: 0 auto 20px auto" class="card-img-top" class="img-fluid rounded" class="" alt="...">
                                @endif
                                <br>
                                <p class="lead">
                                    Room Name : {{ ucfirst($providers->myProvider->name) }}
                                </p>
                                <p class="lead">  
                                    Level : {{ $providers->level}}
                                </p>
                                <p class="lead">
                                    Type of Room : {{ $providers->providerTypes->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 mb-2">
                        <div class="card" >
                            <div class="card-body">
                                <h4 class="text-center">
                                    Book For Meeting Room 
                                </h4>
                                    <input type='date' id="datepicker3" class="form-control mb-2" name="datepicker3" placeholder="Select date">
                                @foreach ($appointments as $appointment )
                                    <input type="hidden" name="end_time" id="end_time" value="{{ $appointment->start_time }}"> 
                                @endforeach
                                @php
                                    $test='<input type="text" id="selected" name="selected" value="">';  
                                @endphp 
                                <select class="form-control mb-2" name="time3" id="time3">
                                </select>
                                <div class="comment mb-2">
                                    <input type="number" id="quantity" style="width: 100%;min-height: 15px" name="quantity" min="1" max="9" placeholder="Hours" required>
                                </div> 
                                <input type="hidden" id="provider_id" name="provider_id" value="{{ $provider_id }}"> 
                                <input type="hidden" id="providerDetails_id" name="providerDetails_id" value="{{ $providerDetails_id }}"> 
                                <input type="hidden" name="providerName" value="{{ $providers->myProvider->name }}"> 
                                <input type="hidden" name="company_name" value="{{ $providers->company_name }}"> 
                                <input type="hidden" name="Add1" value="{{ $providers->myProvider->address1 }}"> 
                                <input type="hidden" name="Add2" value="{{ $providers->myProvider->address2 }}"> 
                                <input type="hidden" name="Add3" value="{{ $providers->myProvider->address3 }}"> 
                                <input type="hidden" name="Add4" value="{{ $providers->myProvider->address4}}"> 
                                <input type="hidden" name="Postcode" value="{{ $providers->myProvider->postcode }}"> 
                                <input type="hidden" name="State" value="{{ $providers->myProvider->state }}"> 
                                <input type="hidden" name="start_time" value="{{ $providers->start_time }}"> 
                                <input type="hidden" name="end_time" value="{{ $providers->end_time }}"> 
                                <input type="hidden" name="doc_email" value="{{ $providers->myProvider->email }}"> 
                                <div class="comment">
                                    <textarea class="textinput" style="width: 100%;min-height: 75px" id="remarks" name="reasons" placeholder="Remarks" required></textarea>
                                </div>
                                @if (Auth::check())
                                    <button type="submit" class="btn btn-success btn-lg main-blink">
                                        <i class="czi-user mr-2 ml-n1"></i>
                                        <span class="btn-txt">{{ __('Proceed') }}</span></button> 
                                @else
                                    <p>Please login or register to make booking</p>
                                    <a href="{{ route('register') }}">Register</a><br>
                                    <a href="{{ route('login') }}">Login</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>
        @endif
    </div>
@endsection
@push('script')
<script> 

    function check() {
    document.getElementById("quantity").checked = true;
    }
    function uncheck() {
    document.getElementById("quantity").checked = false;
    }  

    $("#datepicker1").on('change',function(){
        $('#time').html('');
        $('#time').append('<option value="">----- Processing -----</option>');
        $('#time').attr("disabled", true);

        $.ajax({
            type: "POST",
            url: "{{ route('getTime') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "datepicker": $('#datepicker1').val(),
                "provider_id": $('#provider_id').val(),
                "providerDetails_id":$('#providerDetails_id').val()
            },
        success: function (data) { 
            //  console.log(data);
                        $('#time').html('');
                        $('#time').append('<option value="">----- Please Select -----</option>');
                        $.each(data, function(i,v)
                        {
                            $('#time').append('<option value="'+ v + '">'+ v + '</option>');
                        });

                        $('#time').select().prop("disabled", false);
                    }        
        });
    });
    $("#datepicker3").on('change',function(){

        $('#time3').html('');
        $('#time3').append('<option value="">----- Processing -----</option>');
        $('#time3').attr("disabled", true);
        $.ajax({
            type: "POST",
            url: "{{ route('getTimeCar') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "datepicker": $('#datepicker3').val(),
                "provider_id": $('#provider_id').val(),
                "providerDetails_id":$('#providerDetails_id').val()
            },
        success: function (data) { 
            //  console.log(data);
                        $('#time3').html('');
                        $('#time3').append('<option value="">----- Please Select -----</option>');
                        $.each(data, function(i,v)
                        {
                            $('#time3').append('<option value="'+ v + '">'+ v + '</option>');
                        });

                        $('#time3').select().prop("disabled", false);
                    }        
        });
    });
    $("#datepicker2").on('change',function(){

        $('#time2').html('');
        $('#time2').append('<option value="">----- Processing -----</option>');
        $('#time2').attr("disabled", true);

        $.ajax({
            type: "POST",
            url: "{{ route('getTime') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "datepicker2": $('#datepicker2').val(),
                "provider_id": $('#provider_id').val(),
                "providerDetails_id":$('#providerDetails_id').val()
            },
        success: function (data) { 
            // console.log(data);
                        $('#time2').html('');
                        $('#time2').append('<option value="">----- Please Select -----</option>');
                        $.each(data, function(i,v)
                        {
                            $('#time2').append('<option value="'+ v + '">'+ v + '</option>');
                        });

                        $('#time2').select().prop("disabled", false);
                    }        
        });
    });
    $(function(){
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        var maxDate = year + '-' + month + '-' + day;
        $('#datepicker1').attr('min', maxDate);
        $('#datepicker3').attr('min', maxDate);
    });
    $(document).ready(function() {
        $("#booking").submit(function() {
            $(".result").text("");
            $(".loading-icon").removeClass("hide");
            $(".submit").attr("disabled", true);
            $(".btn-txt").text("Loading...");
        });
    });

    $('#booking').submit(function(e){
    $(this).children('button[type=submit]').attr('disabled', 'disabled');  
    });
</script>
@endpush
