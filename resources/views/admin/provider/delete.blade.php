@extends('admin.layouts.main')
@section('content')

    <div class="container">
        @if (Session::has('msg'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('msg') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="card">
                @if ($users->providerDetails->provider_id == 1)
                    <div class="card-header"><h3>Delete Doctor</h3></div>
                    <div class="card-body">
                        <form action="{{ route('alldoctor.destroy',[$users->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h5>Permanently delete <b>{{ $users->name }}</b> ? You can't undo this  </h5>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">Delete</button>
                                <a href="{{route('alldoctor.index')}}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                @endif
                @if ($users->providerDetails->provider_id == 2)
                    <div class="card-header"><h3>Delete Meeting Room</h3></div>
                    <div class="card-body">
                        <form action="{{ route('allMeetingRoom.destroy',[$users->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h5>Permanently delete <b>{{ $users->name }}</b> ? You can't undo this  </h5>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">Delete</button>
                                <a href="{{route('allMeetingRoom.index')}}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                @endif
                @if ($users->providerDetails->provider_id == 3)
                    <div class="card-header"><h3>Delete Car</h3></div>
                    <div class="card-body">
                        <form action="{{ route('allCar.destroy',[$users->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <h5>Permanently delete <b>{{ $users->name }}</b> ? You can't undo this  </h5>
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">Delete</button>
                                <a href="{{route('allCar.index')}}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection