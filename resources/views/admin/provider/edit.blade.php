@extends('admin.layouts.main')
@section('content')

    <div class="container">
        @if (Session::has('msg'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('msg') }}
            </div>
        @endif
        <div class="row justify-content-center">
            @if ($users->providerDetails->provider_id == 1)
                <div class="card">
                    <div class="card-header"><h3>Edit Doctor</h3></div>
                    <div class="card-body">
                        <form action="{{ url('alldoctor',[$users->id]) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <input type="hidden" name="user_id" class="form-control" value="{{ $users->id }}">
                                    <input type="text" name="name" class="form-control" value="{{ $users->name }}">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="level" class="form-control" placeholder="Level" value="{{ $users->providerDetails->level }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="address1" class="form-control" placeholder="address 1" value="{{ $users->address1 }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="address2" class="form-control" placeholder="address 2" value="{{ $users->address2 }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="address3" class="form-control" placeholder="address 3" value="{{ $users->address3 }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="address4" class="form-control" placeholder="address 4" value="{{ $users->address4 }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="postcode" class="form-control @error('address') is-invalid @enderror" placeholder="Postcode"  value="{{ $users->postcode }}" maxlength="5">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <select name="state" id="STATE" class="form-control" onchange="change_state();">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"  {{ $users->states_id == "$state->id" ? 'selected' : '' }} >{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="company_name" name="company_name" class="form-control" value="{{ $users->providerDetails->company_name }}" placeholder="Company Name">
                                </div>
                                <div class="col-lg-6">
                                    <select name="service" id="service" class="form-control" onchange="change_state();">
                                        <option value="">Services</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" {{ $users->providerDetails->services_id == "$service->id" ? 'selected' : '' }}>{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <select name="provider_type" id="provider_type" class="form-control" onchange="change_state();">
                                        <option value="">Specialist</option>
                                        @foreach ($provider_types as $provider_type)
                                            <option value="{{ $provider_type->id }}" {{ $users->providerDetails->provider_type_id == "$provider_type->id" ? 'selected' : '' }}>{{ $provider_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="">Start Time</label>
                                    <input class="form-control mb-2" type="time" id="StartTime" name="Startime" value="{{ $users->providerDetails->start_time }}">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="">End Time</label>
                                    <input class="form-control mb-2" type="time" id="EndTime" name="EndTime" value="{{ $users->providerDetails->end_time }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label for="">Start Rest Time</label>
                                    <input class="form-control mb-2" type="time" id="startRestTime" name="startRestTime" value="{{ $users->providerDetails->start_rest_time }}">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="">End Rest Time</label>
                                    <input class="form-control mb-2" type="time" id="endRestTime" name="endRestTime" value="{{ $users->providerDetails->end_rest_time }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <select class="form-control mb-2"  name="TimeSlots" id="TimeSlots" onchange="change_state();" aria-valuenow="">
                                        <option value="">Time Slots</option>
                                        <option value="15" {{ $users->providerDetails->slot_duration == 15 ? 'selected' : '' }}>15 Minutes</option>              
                                        <option value="30"{{ $users->providerDetails->slot_duration == 30 ? 'selected' : '' }} >30 Minutes</option>              
                                        <option value="45" {{ $users->providerDetails->slot_duration == 45 ? 'selected' : '' }}>45 Minutes</option>
                                        <option value="60" {{ $users->providerDetails->slot_duration == 60 ? 'selected' : '' }}>1 hour</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            @if ($users->providerDetails->provider_id == 2)
                <div class="card">
                    <div class="card-header"><h3>Edit Meeting Room</h3></div>
                    <div class="card-body">
                        <form action="{{ url('allMeetingRoom',[$users->id]) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <input type="hidden" name="user_id" class="form-control" value="{{ $users->id }}">
                                    <input type="text" name="name" class="form-control" value="{{ $users->name }}">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="level" class="form-control" placeholder="Level" value="{{ $users->providerDetails->level }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="address1" class="form-control" placeholder="address 1" value="{{ $users->address1 }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="address2" class="form-control" placeholder="address 2" value="{{ $users->address2 }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="address3" class="form-control" placeholder="address 3" value="{{ $users->address3 }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="address4" class="form-control" placeholder="address 4" value="{{ $users->address4 }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="postcode" class="form-control @error('address') is-invalid @enderror" placeholder="Postcode"  value="{{ $users->postcode }}" maxlength="5">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <select name="state" id="STATE" class="form-control" onchange="change_state();">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"  {{ $users->states_id == "$state->id" ? 'selected' : '' }} >{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="company_name" name="company_name" class="form-control" value="{{ $users->providerDetails->company_name }}" placeholder="Company Name">
                                </div>
                                <div class="col-lg-6">
                                    <select name="service" id="service" class="form-control" onchange="change_state();">
                                        <option value="">Purpose</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" {{ $users->providerDetails->services_id == "$service->id" ? 'selected' : '' }}>{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <select name="provider_type" id="provider_type" class="form-control" onchange="change_state();">
                                        <option value="">Type of Meeting room</option>
                                        @foreach ($provider_types as $provider_type)
                                            <option value="{{ $provider_type->id }}" {{ $users->providerDetails->provider_type_id == "$provider_type->id" ? 'selected' : '' }}>{{ $provider_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="">Start Time</label>
                                    <input class="form-control mb-2" type="time" id="StartTime" name="Startime" value="{{ $users->providerDetails->start_time }}">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="">End Time</label>
                                    <input class="form-control mb-2" type="time" id="EndTime" name="EndTime" value="{{ $users->providerDetails->end_time }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label for="">Start Rest Time</label>
                                    <input class="form-control mb-2" type="time" id="startRestTime" name="startRestTime" value="{{ $users->providerDetails->start_rest_time }}">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="">End Rest Time</label>
                                    <input class="form-control mb-2" type="time" id="endRestTime" name="endRestTime" value="{{ $users->providerDetails->end_rest_time }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <select class="form-control mb-2"  name="TimeSlots" id="TimeSlots" onchange="change_state();" aria-valuenow="">
                                        <option value="">Time Slots</option>
                                        <option value="15" {{ $users->providerDetails->slot_duration == 15 ? 'selected' : '' }}>15 Minutes</option>              
                                        <option value="30"{{ $users->providerDetails->slot_duration == 30 ? 'selected' : '' }} >30 Minutes</option>              
                                        <option value="45" {{ $users->providerDetails->slot_duration == 45 ? 'selected' : '' }}>45 Minutes</option>
                                        <option value="60" {{ $users->providerDetails->slot_duration == 60 ? 'selected' : '' }}>1 hour</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            @if ($users->providerDetails->provider_id == 3)
                <div class="card">
                    <div class="card-header"><h3>Edit Car</h3></div>
                    <div class="card-body">
                        <form action="{{ url('allCar',[$users->id]) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <input type="hidden" name="user_id" class="form-control" value="{{ $users->id }}">
                                    <input type="text" name="name" class="form-control" value="{{ $users->name }}">
                                </div>
                                <div class="col-lg-6">
                                    <input type="number" name="level" pattern="[0-9.]+" class="form-control" placeholder="Level" value="{{ $users->providerDetails->level }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="address1" class="form-control" placeholder="address 1" value="{{ $users->address1 }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="address2" class="form-control" placeholder="address 2" value="{{ $users->address2 }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="address3" class="form-control" placeholder="address 3" value="{{ $users->address3 }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="address4" class="form-control" placeholder="address 4" value="{{ $users->address4 }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="postcode" class="form-control @error('address') is-invalid @enderror" placeholder="Postcode"  value="{{ $users->postcode }}" maxlength="5">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <select name="state" id="STATE" class="form-control" onchange="change_state();">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"  {{ $users->states_id == "$state->id" ? 'selected' : '' }} >{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="company_name" name="company_name" class="form-control" value="{{ $users->providerDetails->company_name }}" placeholder="Company Name">
                                </div>
                                <div class="col-lg-6">
                                    <select name="service" id="service" class="form-control" onchange="change_state();">
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" {{ $users->providerDetails->services_id == "$service->id" ? 'selected' : '' }}>{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <select name="provider_type" id="provider_type" class="form-control" onchange="change_state();">
                                        <option value="">Model car</option>
                                        @foreach ($provider_types as $provider_type)
                                            <option value="{{ $provider_type->id }}" {{ $users->providerDetails->provider_type_id == "$provider_type->id" ? 'selected' : '' }}>{{ $provider_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="">Start Time</label>
                                    <input class="form-control mb-2" type="time" id="StartTime" name="Startime" value="{{ $users->providerDetails->start_time }}">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="">End Time</label>
                                    <input class="form-control mb-2" type="time" id="EndTime" name="EndTime" value="{{ $users->providerDetails->end_time }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label for="">Start Rest Time</label>
                                    <input class="form-control mb-2" type="time" id="startRestTime" name="startRestTime" value="{{ $users->providerDetails->start_rest_time }}">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label for="">End Rest Time</label>
                                    <input class="form-control mb-2" type="time" id="endRestTime" name="endRestTime" value="{{ $users->providerDetails->end_rest_time }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <select class="form-control mb-2"  name="TimeSlots" id="TimeSlots" onchange="change_state();" aria-valuenow="">
                                        <option value="">Time Slots</option>
                                        <option value="15" {{ $users->providerDetails->slot_duration == 15 ? 'selected' : '' }}>15 Minutes</option>              
                                        <option value="30"{{ $users->providerDetails->slot_duration == 30 ? 'selected' : '' }} >30 Minutes</option>              
                                        <option value="45" {{ $users->providerDetails->slot_duration == 45 ? 'selected' : '' }}>45 Minutes</option>
                                        <option value="60" {{ $users->providerDetails->slot_duration == 60 ? 'selected' : '' }}>1 hour</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection