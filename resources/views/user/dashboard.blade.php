@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">User Dashboard</h3>


        <div class="alert alert-info">
            Welcome, {{ auth()->user()->name }}! Here you can manage your profile and view your activities.
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5>Your Profile</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Role:</strong> {{ ucfirst(auth()->user()->role) }}</p>
                <a href="{{ route('user.profile.edit') }}" class="btn btn-warning">Edit Profile</a>
            </div>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-header bg-success text-white">
                <h5>Recent Activities</h5>
            </div>
            <div class="card-body">
                <ul>
                    <li>Logged in at: {{ now()->format('Y-m-d H:i:s') }}</li>
                    <li>Updated profile recently? <strong>No recent changes</strong></li>
                    <li>Joined on: {{ auth()->user()->created_at->format('Y-m-d') }}</li>
                </ul>
            </div>
        </div>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
@endsection
