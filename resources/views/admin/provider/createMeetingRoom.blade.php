@extends('admin.layouts.main')
@section('content')

    <div class="container">
        @if (Session::has('msg'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('msg') }}
            </div>
        @endif
        <div class="row justify-content-center">
            
            <div class="card">
                <div class="card-header"><h3>Add New Meeting Room</h3></div>
                <div class="card-body">
                    <form action="{{ route('createMeetingRoom') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Room Name" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <input type="text" name="level" class="form-control" value="" placeholder="Floor">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="address1" class="form-control" value="" placeholder="Address 1">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" name="address2" class="form-control" value="" placeholder="Address 2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="address3" class="form-control" value="" placeholder="Address 3">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" name="address4" class="form-control" value="" placeholder="Address 4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="postcode" class="form-control @error('address') is-invalid @enderror" placeholder="Postcode"  value="{{auth()->user()->postcode}}" maxlength="5">
                            </div>
                            <div class="col-md-6 mb-3">
                                <select name="state" id="STATE" class="form-control" onchange="change_state();">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="company_name" name="company_name" class="form-control" value="" placeholder="Company Name">
                            </div>
                            <div class="col-lg-6 mb-3">
                                <select name="service" id="service" class="form-control" onchange="change_state();">
                                    <option value="">Purpose</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <select name="provider_type" id="provider_type" class="form-control" onchange="change_state();">
                                    <option value="">Type of Meeting room</option>
                                    @foreach ($provider_types as $provider_type)
                                        <option value="{{ $provider_type->id }}">{{ $provider_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection