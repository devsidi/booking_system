@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    List all the doctor
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table" id="data_table">
                            <thead>
                                <tr>
                                    <th class="nosort">Avatar</th>
                                    <th>Name</th>
                                    <th>Clinic</th>
                                    <th>Level Education</th>
                                    <th>Action</th>
                                    <th class="nosort">&nbsp;</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @if (Session::has('msg'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('msg') }}
                                    </div>
                                @endif
                                @forelse ($doctors as $doctor)
                                    <tr>
                                        <td><img src="\img\user1.png" class="table-user-thumb" alt=""></td>
                                        <td>{{ $doctor->name }}</td>
                                        <td>{{ $doctor->providerDetails->company_name }}</td>
                                        <td>{{ $doctor->providerDetails->level }}</td>
                                        <td>
                                            <a href="{{ route('alldoctor.show',[$doctor->id]) }}" class="btn btn-danger mb-2" style="width: 100px;display:inline-block">Delete</a>
                                            <a href="{{route('alldoctor.edit',[$doctor->id])}}" class="btn btn-success mb-2" style="width: 100px;display:inline-block">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <h5>You have no doctor .</h5>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection