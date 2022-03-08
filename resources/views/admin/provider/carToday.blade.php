@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    List of Car
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table" id="data_table">
                            <thead>
                                <tr>
                                    <th class="nosort" hidden>Avatar</th>
                                    <th style="text-align:center">Requestor Name</th>
                                    <th style="text-align:center">Request Date</th>
                                    <th style="text-align:center">Request Time</th>
                                    <th style="text-align:center">Duration (hours)</th>
                                    <th style="text-align:center">Car Name</th>
                                    <th style="text-align:center">Remarks (Requestor)</th>
                                    <th style="text-align:center">Actions</th> 
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
                                @if (Session::has('msg-cancel'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('msg-cancel') }}
                                    </div>
                                @endif
                                @forelse ($cars as $car) 
                                    <tr>
                                        <td hidden><img src="\img\user1.png" class="table-user-thumb" alt=""></td>
                                        <td width="10%" style="text-align:center">{{ $car->user->name }}</td>
                                        <td width="10%" style="text-align:center">{{ \Carbon\Carbon::parse($car->start_date)->format('d/m/Y') }}</td>
                                        <td width="10%" style="text-align:center">{{ \Carbon\Carbon::parse($car->start_time)->format('H:i') }}</td>
                                        <td width="10%" style="text-align:center">{{ $car->duration }} </td>
                                        <td width="10%" style="text-align:center">{{ $car->providerDetailsApp->users->name }}</td>
                                        <td width="10%" style="text-align:center">{{ $car->remarks }} </td>
                                        <td width="10%" style="text-align:center">
                                        @if ($car-> status == 0 )
                                            <button style="margin:5px; width:100px;" type="submit" class="btn btn-success"><a href = "{{ url('/admin-car-app',[$car->id]) }}">Approve</a></button>
                                            <button style="margin:5px; width:100px;" type="submit" class="btn btn-danger"><a href = "{{ url('/admin-car-cancel',[$car->id]) }}">cancel</a></button>
                                            @elseif ($car-> status == 2) 
                                            <p style="color:red;">Cancelled</p>
                                            @else
                                            <p style="color:green;">Approved</p>                                             
                                            @endif
                                        </td>
                                        <td width="20%" style="text-align:center">
                                            @if ( $car->remark_approval == null)
                                                            -
                                            @else
                                            {{ $car->remark_approval }}
                                            @endif 
                                        </td>
                                    </tr>
                                @empty
                                    <h5>You have no Car has been reserve.</h5>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection