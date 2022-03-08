@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    List Meeting Room
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table" id="data_table">
                            <thead>
                                <tr>
                                    <th class="nosort" hidden>Avatar</th>
                                    <th>Room Name</th>
                                    <th>Company</th>
                                    <th>Level</th>
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
                                @forelse ($rooms as $room)
                                    <tr>
                                        <td hidden><img src="\img\user1.png" class="table-user-thumb" alt=""></td>
                                        <td>{{ $room->name }}</td>
                                        <td>{{ $room->providerDetails->company_name }}</td>
                                        <td>{{ $room->providerDetails->level }}</td>
                                        <td>
                                            <a href="{{ route('allMeetingRoom.show',[$room->id]) }}" class="btn btn-danger mb-2" style="width: 100px;display:inline-block">Delete</a>
                                            <a href="{{route('allMeetingRoom.edit',[$room->id])}}" class="btn btn-success mb-2" style="width: 100px;display:inline-block">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <h5>You have no Meeting Room.</h5>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection