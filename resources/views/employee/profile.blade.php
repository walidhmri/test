@extends('layouts.app')

@section('title', 'Profile')


@section('content')
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header bg-gradient-dark text-white">
            <h5 class="mb-0">Your Profile</h5>
          </div>
          <div class="card-body">
            
              <div class="row">
                <div class="col-md-6">
                  <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
                  <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                  <p><strong>Joined:</strong> {{ Auth::user()->created_at->format('F j, Y') }}</p>
                </div>
                <div class="col-md-6 text-end">
                  <a href="{{ route('employee.profile.edits') }}" class="btn bg-gradient-dark">Edit Profile</a>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection