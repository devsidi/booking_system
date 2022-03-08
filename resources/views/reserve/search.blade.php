@extends('layouts.app')
@section('content')
<div class="container" >
    <div class="row text-center">
        <div class="col-12 text-center">
            <h2>Online Booking </h2>
        </div>
    </div>
    <div class="mb-5">
        <form class="form-inline justify-content-center" action="{{ url('/search') }}" method="GET" role="search">
            {{csrf_field()}}
            <select class="form-control mb-2 mr-2" id="provider" name="provider" data-dependent="provider">
                <option value=""hidden >Services</option>
                @foreach ($providers as $provider)
                <option value="{{ $provider->id }}" >{{ $provider->name }}</option>
                @endforeach
            </select>
            <select class="form-control mb-2 mr-2" id="service" name="service" disabled hidden>
                <option value="">Service</option>  
            </select>
            <select class="form-control mb-2 mr-2" name="company" id="company" disabled>
                <option value="">Company Name</option>
            </select>
            <input type="text" class="form-control mb-2 mr-2" name="add" placeholder="Enter Location" id="add" disabled>
            <input type="text" class="form-control mb-2 mr-2" name="keyword" placeholder="Enter Provider,Company,etc.. " id="keyword" disabled>
            <button type="submit" class="btn btn-primary mb-2">Search</button>
        </form>
    </div>    
        <div class="row mb-3">
            @forelse ($reserves as $reserve)
                <div class="col-sm-4 mb-2">
                    <div class="card text-center h-100">
                        <!-- provider Doctor -->
                        @if ($reserve->provider_id=='1')
                            <img src="/img/dr.png" style="background-size: cover; border-radius: 999px; height: 120px; width: 120px; margin: 0 auto 20px auto" class="card-img-top" class="img-fluid rounded" class="" alt="...">
                            <h3 class="card-title text-black">{{ ucfirst($reserve->name) }}</h3>
                            <p class="card-text">{{ $reserve->level }} </p>
                            <p class="card-text text-black-50">Location</p>
                            <p class="card-text">{{ $reserve->company_name }}</p> 
                                @if($reserve->address1 != '')
                                <p class="card-text">
                                {{ $reserve->address1 }},
                                @endif 
                                @if($reserve->address2 != '')
                                {{ $reserve->address2 }},
                                @endif 
                                @if($reserve->address3 != '')
                                {{ $reserve->address3 }},
                                @endif 
                                @if($reserve->address4 != '')
                                {{ $reserve->address4 }},
                                @endif  
                                {{ $reserve->postcode }},
                                {{ $reserve->userStates->name }}.
                                </p>
                                <!-- provider Meeting room  -->
                        @elseif ($reserve->provider_id=='2')
                            <img src="/img/meeting.png" style="background-size: cover; border-radius: 999px; height: 120px; width: 120px; margin: 0 auto 20px auto" class="card-img-top" class="img-fluid rounded" class="" alt="...">
                            <h3 class="card-title text-black">{{ ucfirst($reserve->name) }}</h3>
                            <p class="card-text">{{ $reserve->level }} </p>
                            <p class="card-text text-black-50">Location</p>
                            <p class="card-text">{{ $reserve->company_name }}</p> 
                                @if($reserve->address1 != '')
                                <p class="card-text">
                                {{ $reserve->address1 }},
                                @endif 
                                @if($reserve->address2 != '')
                                {{ $reserve->address2 }},
                                @endif 
                                @if($reserve->address3 != '')
                                {{ $reserve->address3 }},
                                @endif 
                                @if($reserve->address4 != '')
                                {{ $reserve->address4 }},
                                @endif  
                                {{ $reserve->postcode }},
                                {{ $reserve->userStates->name }}.
                                </p>
                        @else
                        <!-- provider car Company -->
                            <img src="/img/car.png" style="background-size: cover; border-radius: 999px; height: 120px; width: 120px; margin: 0 auto 20px auto" class="card-img-top" class="img-fluid rounded" class="" alt="...">
                            <h3 class="card-title text-black">{{ ucfirst($reserve->name) }}</h3>
                            <p class="card-text">{{ $reserve->level }} Seater</p>
                            <p class="card-text text-black-50">Location</p>
                            <p class="card-text">{{ $reserve->company_name }}</p> 
                                @if($reserve->address1 != '')
                                <p class="card-text">
                                {{ $reserve->address1 }},
                                @endif 
                                @if($reserve->address2 != '')
                                {{ $reserve->address2 }},
                                @endif 
                                @if($reserve->address3 != '')
                                {{ $reserve->address3 }},
                                @endif 
                                @if($reserve->address4 != '')
                                {{ $reserve->address4 }},
                                @endif  
                                {{ $reserve->postcode }},
                                {{ $reserve->userStates->name }}.
                                </p>
                        @endif  
                        <div class="card-footer bg-transparent">
                                <a href="{{ route('booking',[$reserve->provider_id,$reserve->id]) }}" class="btn btn-primary">Book</a>
                        </div>
                    </div>
                </div>
            @empty
        <div class="container">
            <h4 style="text-align: center;">No data available.</h4>
        </div>
            @endforelse
        </div>
</div>
@endsection
@push('script')
    <script>
        $('#provider').change(function(){
            var providerID = $(this).val();  
            if(providerID){
                $.ajax({
                type:"GET",
                url:"{{url('getProvider')}}?provider="+providerID,
                success:function(res){        
                if(res){
                    $("#service").empty();
                    $("#service").append('<option>Select Service</option>');
                    $.each(res,function(key,services){
                    $("#service").append('<option value="'+key+'">'+services.name+'</option>');
                    });
                
                }else{
                    $("#service").empty();
                }
                }
                });
            }else{
                $("#service").empty();
                $("#company").empty();
            }   
            });
            $('#service').on('change',function(){
            var serviceID = $(this).val();  
            if(serviceID){
                $.ajax({
                type:"GET",
                url:"{{url('getCompany')}}?service="+serviceID,
                success:function(res){        
                if(res){
                    $("#company").empty();
            $("#company").append('<option>Select Company</option>');
                    $.each(res,function(key,company){
                    $("#company").append('<option value="'+key+'">'+company.company_name+'</option>');
                    });
                
                }else{
                    $("#company").empty();
                }
                }
                });
            }else{
                $("#company").empty();
            }
            });
    </script> 
@endpush