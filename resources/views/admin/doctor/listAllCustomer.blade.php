@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    List Patients
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table" id="data_table">
                            <thead>
                                <tr>
                                    <th class="nosort">Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Time</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th class="nosort">Actions</th>
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
                                        <td>{{ $appointment->user->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($appointment->start_date)->format('d/m/Y') }}</td>
                                        @if ($appointment->status==0)
                                            <td>not checked</td>
                                        @elseif ($appointment->status==2)
                                            <td>Cancelled</td>
                                        @else
                                            <td>checked</td>
                                        @endif
                                        <td>
                                            <form action="{{ url('/allPatient-update') }}"  method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $appointment->user_id }}">
                                                <input type="hidden" name="start_time" value="{{ $appointment->start_time }}">
                                                <input type="hidden" name="start_date" value="{{ $appointment->start_date }}">
                                                <button type="submit" class="btn btn-success mb-2" style="width: 100px;display:inline-block">
                                                    <i class="fas fa-check"> Attend</i>
                                                </button>
                                            </form>
                                            <form action="{{ url('/allPatient-cancel') }}"  method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $appointment->user_id }}">
                                                <input type="hidden" name="start_time" value="{{ $appointment->start_time }}">
                                                <input type="hidden" name="start_date" value="{{ $appointment->start_date }}">
                                                <button type="submit" class="btn btn-danger" style="width: 100px;display:inline-block">
                                                    <i class="fas fa-times"> Cancel</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <h5>You have no upcoming appointments.</h5>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection