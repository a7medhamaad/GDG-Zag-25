@extends('layouts.app')

@section('title', 'Profile Details')

@section('content')
    <h1 class="mb-4">Profile Details</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-title">{{ $profiles['name'] }}</h4>
            <p class="card-text"><strong>Age:</strong> {{ $profiles['age'] }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $profiles['email'] }}</p>
            <a href="{{ url('/profiles') }}" class="btn btn-secondary mt-3">← Back to All Profiles</a>
        </div>
    </div>
@endsection
