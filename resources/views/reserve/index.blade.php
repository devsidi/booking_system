@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col-12 text-center">
        <h2>Online Booking </h2>
        </div>
        <div class="col-12">
        </div>
    </div>
    <div class="mb-5">
        <form class="form-inline justify-content-center" action="{{ url('/search') }}" method="GET" role="search">
            {{csrf_field()}}
             <!-- Can add label if want -->
            <select class="form-control mb-2 mr-2" id="provider" name="provider" data-dependent="provider">
                <option value="" selected disabled>Services</option>
                @foreach ($providers as $provider)
                <option value="{{ $provider->id }}" >{{ $provider->name }}</option>
                @endforeach
            </select>
            <select class="form-control mb-2 mr-2 dynamic" id="service" name="service" data-dependent="service"disabled hidden>
                <option value="">Service</option>
            </select>
            <select class="form-control mb-2 mr-2 dynamic" name="company" id="company" data-dependent="company" disabled >
                <option value="">Company Name</option>
            </select>
            <input type="text" class="form-control mb-2 mr-2" name="add" placeholder="Enter Location" id="add" disabled >
            <input type="text" class="form-control mb-2 mr-2" name="keyword" placeholder="Enter Provider,Company,Specialist,etc.. " id="keyword" disabled>
            <button type="submit" class="btn btn-primary mb-2 mr-2">Search</button>
        </form>
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