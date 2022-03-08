@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                <legend>Approve Room booking request</legend>
                </div>
                <div class="card-body">
                <form action="{{url('/booking-room-app')}}" method="post">
                @csrf
                    <fieldset>
                        <div class="mb-3">
                        <label for="" class="form-label">Add remarks for Approval</label>
                        <input type="hidden" id="admin" name="admin" class="form-control" value="Approved by {{ ucfirst(Auth::user()->name) }}">
                        <input type="hidden" id="rm_id" name="rm_id" class="form-control" value="{{$rooms->id}}">
                        <input type="text" id="admin_remarks" name="admin_remarks" class="form-control" value="" required>
                        <input style="margin:5px;" type="submit" class="btn btn-primary">
                        </div>  
                    </fieldset>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection