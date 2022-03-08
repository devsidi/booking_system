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
                <div class="card-header"><h3>Add New Car</h3></div>
                <div class="card-body">
                    <form action="{{ route('createCar') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Car Name" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <input type="number" name="level" pattern="[0-9.]+" class="form-control" placeholder="Seater" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="add1" class="form-control" placeholder="Address 1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" name="add2" class="form-control" placeholder="Address 2" >
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="add3" class="form-control" placeholder="Address 3" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" name="add4" class="form-control" placeholder="Address 4" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="postcode" class="form-control" placeholder="Postcode"  maxlength="5" required> 
                            </div>
                            <div class="col-md-6 mb-3">
                                <select name="state" id="STATE" class="form-control" onchange="change_state();" required>
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="role_id" class="form-control" value="4">
                            <div class="col-md-6 mb-3">
                                <input type="company_name" name="company_name" class="form-control" value="" placeholder="Company Name" required>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <select name="service" id="service" class="form-control" onchange="change_state();" required>
                                    <option value="">Transmission</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <select name="provider_type" id="provider_type" class="form-control" onchange="change_state();" required>
                                    <option value="">Model Car</option>
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