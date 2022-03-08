@extends('admin.layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            @if (Auth::user()->role->name=="admin")
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Car</h6>
                                    <h2>{{App\Models\provider_details::where('provider_id',3)->count()}}</h2>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-car"></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                        </div>
                    </div>
                </div>
            @endif
            @if (Auth::user()->role->name=="admin")
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Meeting Room</h6>
                                    <h2>{{App\Models\provider_details::where('provider_id',2)->count()}}</h2>
                                </div>
                                <div class="icon">
                                    <i class='fas fa-chalkboard-teacher'></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                        </div>
                    </div>
                </div>
            @endif
            @if (Auth::user()->role->name=="doctor")
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Today Patient</h6>
                                    <h2>{{app\Models\Appointment::where('start_date',date('Y-m-d'))->where('status',0)->where('providerDetails_id',auth()->user()->id)->count()}}</h2>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-injured"></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                        </div>
                    </div>
                </div>
            @endif
            @if (Auth::user()->role->name=="doctor")
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Upcoming appointment</h6>
                                    <h2>{{app\Models\Appointment::where('providerDetails_id',auth()->user()->id)->where('start_date','>',date('Y-m-d'))->count() }}</h2>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-procedures"></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                        </div>
                    </div>
                </div>
            @endif
            @if (Auth::user()->role->name=="doctor")
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Expired appoinment</h6>
                                    <h2>{{app\Models\Appointment::where('providerDetails_id',auth()->user()->id)->where('start_date','<',date('Y-m-d'))->count()}}</h2>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                        </div>
                    </div>
                </div>
            @endif
            @if (Auth::user()->role->name=="superadmin")
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Doctors</h6>
                                    <h2>{{app\Models\User::where('role_id',1)->count()}}</h2>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Cars</h6>
                                    <h2>{{app\Models\User::where('role_id',5)->count()}}</h2>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-car"></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-grey" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Meeting Rooms</h6>
                                    <h2>{{app\Models\User::where('role_id',6)->count()}}</h2>
                                </div>
                                <div class="icon">
                                    <i class='fas fa-chalkboard-teacher'></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Appointment</h6>
                                    <h2>{{app\Models\Appointment::count()}}</h2>
                                </div>
                                <div class="icon">
                                    <i class="far fa-handshake"></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Total Customer</h6>
                                    <h2>{{app\Models\User::where('role_id',3)->count()}}</h2>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection