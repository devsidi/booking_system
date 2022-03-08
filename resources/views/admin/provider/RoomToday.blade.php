@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    List of Meeting Room
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table" id="data_table">
                            <thead>
                                <tr>
                                    <th class="nosort" hidden>Avatar</th>
                                    <th style="text-align:center" >Requestor Name</th>
                                    <th style="text-align:center" >Request Date</th>
                                    <th style="text-align:center" >Request Time</th>
                                    <th style="text-align:center">Duration (Hours)</th>
                                    <th style="text-align:center">Room Name</th>
                                    <th style="text-align:center">Level</th>
                                    <th style="text-align:center">Remarks (Requestor)</th>
                                    <th style="text-align:center">Action</th>
                                    <th style="text-align:center">Admin Remarks</th>
                                    <th class="nosort" hidden>&nbsp;</th> 
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
                                        <td width="10%" style="text-align:center">{{ $room->user->name }}</td>
                                        <td width="10%" style="text-align:center">{{ \Carbon\Carbon::parse($room->start_date)->format('d/m/Y') }}</td>
                                        <td width="10%" style="text-align:center">{{ \Carbon\Carbon::parse($room->start_time)->format('H:i') }}</td>
                                        <td width="10%" style="text-align:center">{{ $room->duration }}</td>
                                        <td width="10%" style="text-align:center">{{ $room->providerDetailsApp->users->name }}</td>
                                        <td width="10%" style="text-align:center">{{ $room->providerDetailsApp->level }}</td>
                                        <td width="10%" style="text-align:center">{{ $room->remarks }} </td>
                                        <td width="10%" style="text-align:center">
                                        @if ($room-> status == 0 ) 
                                            <button style="margin:5px; width:100px;" type="submit" class="btn btn-success"><a href = "{{url('/admin-room-app',[$room->id])}}">Approve</a></button> 
                                            <button style="margin:5px; width:100px;" type="submit" class="btn btn-danger"><a href = "{{ url('/admin-room-cancel',[$room->id]) }}">cancel</a></button>
                                            @elseif ($room-> status == 2) 
                                            <p style="color:red;">Cancelled</p>
                                            @else
                                            <p style="color:green;">Approved</p>                                             
                                            @endif
                                        </td>
                                        <td width="20%" style="text-align:center">
                                            @if ( $room->remark_approval == null)
                                                            -
                                            @else
                                            {{ $room->remark_approval }}
                                            @endif 
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