@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    List Appointment
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table" id="data_table">
                            <thead>
                                <tr>
                                    <th class="nosort">Avatar</th>
                                    <th>Name</th>
                                    <th>Provider</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th class="nosort">&nbsp;</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @if (Session::has('msg'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('msg') }}
                                    </div>
                                @endif
                                @forelse ($appointments as $appointment)
                                    <tr>
                                        <td><img src="\img\user1.png" class="table-user-thumb" alt=""></td>
                                        <td>{{ $appointment->user->name }}</td>
                                        <td>{{ $appointment->provider->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($appointment->start_date)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}</td>
                                    </tr>
                                @empty
                                    <h5>You have no Appointment .</h5>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection