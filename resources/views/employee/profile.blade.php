@extends('layouts.app')

@section('content')
@push('styles')
<style>
  .page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
  }
  
  .page-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-color);
    margin: 0;
  }
  
  .profile-grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 1.5rem;
  }
  
  @media (max-width: 991.98px) {
    .profile-grid {
      grid-template-columns: 1fr;
    }
  }
  
  .profile-card {
    background-color: var(--bg-card);
    border-radius: 12px;
    box-shadow: 0 2px 12px var(--shadow-color);
    overflow: hidden;
    height: fit-content;
  }
  
  .profile-header {
    background-color: var(--primary-color);
    padding: 2rem 1.5rem;
    text-align: center;
    color: white;
    position: relative;
  }
  
  .profile-cover {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100%;
    background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
    opacity: 0.8;
  }
  
  .profile-avatar {
    position: relative;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: white;
    color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 auto 1rem;
    border: 4px solid white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }
  
  .profile-name {
    position: relative;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
  }
  
  .profile-role {
    position: relative;
    font-size: 0.875rem;
    opacity: 0.9;
  }
  
  .profile-body {
    padding: 1.5rem;
  }
  
  .profile-info-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  .profile-info-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--border-color);
  }
  
  .profile-info-item:last-child {
    border-bottom: none;
  }
  
  .profile-info-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background-color: var(--primary-light);
    color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
  }
  
  .profile-info-content {
    flex: 1;
  }
  
  .profile-info-label {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin-bottom: 0.25rem;
  }
  
  .profile-info-value {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text-color);
  }
  
  .form-card {
    background-color: var(--bg-card);
    border-radius: 12px;
    box-shadow: 0 2px 12px var(--shadow-color);
    overflow: hidden;
  }
  
  .form-card-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: center;
  }
  
  .form-card-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background-color: var(--primary-light);
    color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
  }
  
  .form-card-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-color);
    margin: 0;
  }
  
  .form-card-body {
    padding: 1.5rem;
  }
  
  .form-group {
    margin-bottom: 1.5rem;
  }
  
  .form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--text-color);
  }
  
  .form-control {
    display: block;
    width: 100%;
    padding: 0.75rem 1rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: var(--text-color);
    background-color: var(--input-bg);
    background-clip: padding-box;
    border: 1px solid var(--input-border);
    border-radius: 8px;
    transition: all 0.2s ease;
  }
  
  .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px var(--input-focus-shadow);
    outline: 0;
  }
  
  .form-control::placeholder {
    color: var(--text-muted);
    opacity: 0.7;
  }
  
  .form-text {
    margin-top: 0.25rem;
    font-size: 0.75rem;
    color: var(--text-muted);
  }
  
  .invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.75rem;
    color: var(--danger-color);
  }
  
  .is-invalid {
    border-color: var(--danger-color);
  }
  
  .is-invalid:focus {
    border-color: var(--danger-color);
    box-shadow: 0 0 0 3px rgba(245, 101, 101, 0.25);
  }
  
  .form-footer {
    padding: 1.25rem 1.5rem;
    border-top: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.75rem;
  }
  
  .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    line-height: 1.5;
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    cursor: pointer;
    user-select: none;
    border: 1px solid transparent;
    border-radius: 8px;
    transition: all 0.2s ease;
    gap: 0.5rem;
  }
  
  .btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
  }
  
  .btn-primary:hover {
    background-color: var(--primary-hover);
    border-color: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 122, 0, 0.3);
  }
  
  .btn-secondary {
    background-color: var(--bg-main);
    border-color: var(--border-color);
    color: var(--text-color);
  }
  
  .btn-secondary:hover {
    background-color: var(--hover-bg);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px var(--shadow-color);
  }
  
  .btn-danger {
    background-color: var(--danger-color);
    border-color: var(--danger-color);
    color: white;
  }
  
  .btn-danger:hover {
    background-color: #e53e3e;
    border-color: #e53e3e;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(245, 101, 101, 0.3);
  }
  
  @media (max-width: 767.98px) {
    .form-footer {
      flex-direction: column;
      gap: 0.75rem;
    }
    
    .form-footer .btn {
      width: 100%;
    }
  }
</style>
@endpush

<div class="page-header">
  <h1 class="page-title">Mon profil</h1>
</div>

<div class="profile-grid">
  <div class="profile-card">
    <div class="profile-header">
      <div class="profile-cover"></div>
      <div class="profile-avatar">
        {{ substr(Auth::user()->name, 0, 1) }}
      </div>
      <h2 class="profile-name">{{ Auth::user()->name }}</h2>
      <p class="profile-role">{{ Auth::user()->department_name }}</p>
    </div>
    
    <div class="profile-body">
      <ul class="profile-info-list">

        
        <li class="profile-info-item">
          <div class="profile-info-icon">
            <i class="material-symbols-rounded">email</i>
          </div>
          <div class="profile-info-content">
            <div class="profile-info-label">User Id</div>
            <div class="profile-info-value">{{ Auth::user()->email }}</div>
          </div>
        </li>
        
        <li class="profile-info-item">
          <div class="profile-info-icon">
            <i class="material-symbols-rounded">business</i>
          </div>
          <div class="profile-info-content">
            <div class="profile-info-label">Département</div>
            <div class="profile-info-value">{{ Auth::user()->department_name }}</div>
          </div>
        </li>
        
        <li class="profile-info-item">
          <div class="profile-info-icon">
            <i class="material-symbols-rounded">calendar_today</i>
          </div>
          <div class="profile-info-content">
            <div class="profile-info-label">Membre depuis</div>
            <div class="profile-info-value">{{ Auth::user()->created_at->format('d M Y') }}</div>
          </div>
        </li>
      </ul>
    </div>
  </div>
  
  <div>
    <div class="form-card mb-4">
      <div class="form-card-header">
        <div class="form-card-icon">
          <i class="material-symbols-rounded">edit</i>
        </div>
        <h2 class="form-card-title">Modifier le profil</h2>
      </div>
      
      <form action="{{ route('employee.profile.update') }}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="form-card-body">
          <div class="form-group">
            <label for="name" class="form-label">Nom complet</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="priority" class="form-label">Language </label>
            <select class="form-select  is-invalid " id="locale" name="locale">
              <option value="" disabled selected></option>
              <option value="fr" {{ auth::user()->localization== 'fr' ? 'selected' : '' }}>Francais</option>
              <option value="en" {{ auth::user()->localization == 'en' ? 'selected' : '' }}>English</option>
              <option value="ar" {{ auth::user()->localization == 'ar' ? 'selected' : '' }}>العربية</option>
              <option value="tm" {{ auth::user()->localization == 'tm' ? 'selected' : '' }}>Taqvaylit</option>
            </select>

          </div>
         
          
          <div class="form-group">
            <label for="email" class="form-label">User Id</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" readonly>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        
        <div class="form-footer">
          <button type="submit" class="btn btn-primary">
            <i class="material-symbols-rounded">save</i>
            Enregistrer les modifications
          </button>
        </div>
      </form>
    </div>
    
    <div class="form-card">
      <div class="form-card-header">
        <div class="form-card-icon">
          <i class="material-symbols-rounded">lock</i>
        </div>




        <h2 class="form-card-title">Changer le mot de passe</h2>
      </div>
      @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
      <form action="{{route('employee.profile.password')}}" method="POST">
        @csrf
        @method('patch')
        
        <div class="form-card-body">
          <div class="form-group">
            <label for="current_password" class="form-label">Mot de passe actuel</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
            @error('current_password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="new_password" required>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Le mot de passe doit contenir au moins 8 caractères.</div>
          </div>
          
          <div class="form-group">
            <label for="confirmation_password" class="form-label">Confirmer le nouveau mot de passe</label>
            <input type="password" class="form-control" id="password_confirmation" name="new_password_confirmation" required>
          </div>
        </div>
        
        <div class="form-footer">
          <button type="submit" onclick="confirm('are you sure to change password ?')" class="btn btn-primary">
            <i class="material-symbols-rounded">lock_reset</i>
            Mettre à jour le mot de passe
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

