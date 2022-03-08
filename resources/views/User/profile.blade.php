
    @extends(\Auth::user()->role->id==1 || \Auth::user()->role->id==4 || \Auth::user()->role->id==2 ?'admin.layouts.main':'layouts.app')

    @section('content')
        <div class="container">
            <div class="row ">
                <div class="col-lg-8 mb-3">
                    @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                    @endif
                    <div class="card">
                        <div class="card-header">Update Profile</div>
                        <div class="card-body">
                            <form action="{{ url('/user-profile-update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col mb-3">
                                        <input type="text" name="name" class="form-control" id="name" value="{{auth()->user()->name}}" placeholder="Name">
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="email" class="form-control" value="{{auth()->user()->email}}" placeholder="E-mail">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="cc_email" class="form-control" id="cc_email" value="{{auth()->user()->cc_email}}" placeholder="Manager/supervisor Email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="address1" class="form-control" value="{{auth()->user()->address1}}" placeholder="Address 1">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="address2" class="form-control" value="{{auth()->user()->address2}}" placeholder="Address 2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="address3" class="form-control" value="{{auth()->user()->address3}}" placeholder="Address 3">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="address4" class="form-control" value="{{auth()->user()->address4}}" placeholder="Address 4">
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
                                                <option value="{{ $state->id }}"  {{ auth()->user()->states_id == "$state->id" ? 'selected' : '' }} >{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if (Auth::user()->role->id==1 )
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="phone_number" class="form-control" value="{{auth()->user()->phone_number}}" placeholder="Phone number">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <select name="service" id="service" class="form-control" onchange="change_state();">
                                                <option value="">Select Service</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}" {{ auth()->user()->providerDetails->services_id == "$service->id" ? 'selected' : '' }}>{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="company_name" class="form-control" value="{{auth()->user()->providerDetails->company_name ?? ''}}" placeholder="clinic Name">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <select name="provider_type" id="provider_type" class="form-control" onchange="change_state();">
                                                <option value="">Specialist</option>
                                                @foreach ($provider_types as $provider_type)
                                                    <option value="{{ $provider_type->id }}"  {{ auth()->user()->providerDetails->provider_type_id == "$provider_type->id" ? 'selected' : '' }} >{{ $provider_type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" name="level" class="form-control" value="{{auth()->user()->providerDetails->level  ?? ''}}" placeholder="Career">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Images</label>
                                        <input type="file" name="image" class="form-control" value="">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>
                        </div>    
                    </div>
                </div>
            </div>
        </div>    
        
    @endsection