@extends('layouts.app')

@section('title', 'Edit Profile')

@section('breadcrumb', 'Edit Profile')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <div class="card shadow-sm">
        <div class="card-header-gradient shadow-dark border-radius-lg">
          <h5 class="text-white text-capitalize ps-3 mb-0">Edit Profile</h5>
        </div>
        <div class="card-body p-4">
          @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
              <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          
          <form method="POST" action="{{ route('employee.profile.update') }}" class="mt-3">
            @csrf
            @method('PATCH')
            
            <div class="mb-4">
              <label for="name" class="form-label">Name</label>
              <input 
                name="name" 
                type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name', Auth::user()->name) }}" 
                required
                autocomplete="name"
              >
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="mb-4">
              <label for="password" class="form-label">Password</label>
              <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control @error('password') is-invalid @enderror" 
                placeholder="********" 
                required
              >
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <small class="text-muted">Leave blank to keep your current password</small>
            </div>
            
            <div class="mb-4">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
              <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                class="form-control" 
                placeholder="********"
              >
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-4">
              <a href="{{ route('employee.profile.edit') }}" class="btn btn-outline-secondary">Cancel</a>
              <button type="submit" class="btn btn-primary-custom">
                <i class="material-symbols-rounded me-2">save</i>
                Save Changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection