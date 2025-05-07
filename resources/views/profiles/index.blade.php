@extends('layouts.app')

@section('title', 'All Profiles')

@section('content')
    <h1 class="mb-4">All Profiles</h1>

    <div class="row">
        @foreach($profiles as $id => $profile)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $profile['name'] }}</h5>
                        <p class="card-text"><strong>Age:</strong> {{ $profile['age'] }}</p>
                        <a href="{{ url('/profiles/' . $id) }}" class="btn btn-outline-primary btn-sm">View Profile</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
