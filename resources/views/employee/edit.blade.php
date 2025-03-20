@extends('layouts.app')

@section('title', 'Edit Profile')

@section('breadcrumb', 'Edit Profile')

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="card shadow-sm">
          <div class="card-header bg-gradient-dark text-white">
            <h5 class="mb-0">Edit Profile</h5>
            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('employee.profile.update') }}">
              @csrf
              @method('PATCH')
              <div class="mb-3">
                <label for="username" class="form-label">Name</label>
                <input name="name" type="text" class="form-control is-invalid"    value="{{ old('username', Auth::user()->name) }}" required>

              </div>
              <div class="mb-3">
                
                <label for="password" class="">password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="********" required>
              </div>
              <button type="submit" class="btn bg-gradient-dark">Save Changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
