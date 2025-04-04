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
  
  .page-actions {
    display: flex;
    gap: 0.75rem;
  }
  
  .form-card {
    background-color: var(--bg-card);
    border-radius: 12px;
    box-shadow: 0 2px 12px var(--shadow-color);
    overflow: hidden;
    margin-bottom: 1.5rem;
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
  
  .form-select {
    display: block;
    width: 100%;
    padding: 0.75rem 1rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: var(--text-color);
    background-color: var(--input-bg);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 16px 12px;
    border: 1px solid var(--input-border);
    border-radius: 8px;
    appearance: none;
    transition: all 0.2s ease;
  }
  
  .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px var(--input-focus-shadow);
    outline: 0;
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
  
  .tips-card {
    background-color: var(--primary-light);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
  }
  
  .tips-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  .tips-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 0.75rem;
    color: var(--text-color);
  }
  
  .tips-icon {
    color: var(--primary-color);
    margin-right: 0.75rem;
    flex-shrink: 0;
    margin-top: 0.25rem;
  }
  
  @media (max-width: 767.98px) {
    .page-header {
      flex-direction: column;
      align-items: flex-start;
      gap: 1rem;
    }
    
    .page-actions {
      width: 100%;
    }
    
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
  <h1 class="page-title">Créer un nouveau ticket</h1>
  <div class="page-actions">
    <a href="{{ route('employee.tickets.list') }}" class="btn btn-secondary">
      <i class="material-symbols-rounded">list</i>
      Voir tous les tickets
    </a>
  </div>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="form-card">
      <div class="form-card-header">
        <div class="form-card-icon">
          <i class="material-symbols-rounded">add_circle</i>
        </div>
        <h2 class="form-card-title">Informations du ticket</h2>
      </div>
      
      <form action="{{ route('employee.tickets.store') }}" method="POST">
        @csrf
        
        <div class="form-card-body">
          <div class="form-group">
            <label for="title" class="form-label">Titre <span style="color: red">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Entrez un titre descriptif" required>
            @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group">
            <label for="description" class="form-label">Description <span style="color: red">*</span></label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Décrivez votre problème en détail" required>{{ old('description') }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="priority" class="form-label">Priorité <span style="color: red">*</span></label>
                <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>
                  <option value="" disabled selected>Sélectionnez une priorité</option>
                  <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Basse</option>
                  <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Moyenne</option>
                  <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Haute</option>
                  <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgente</option>
                </select>
                @error('priority')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label for="title" class="form-label">File</label>
              <input type="file" class="form-control @error('title') is-invalid @enderror" id="file" name="file" value="{{ old('file') }}">
              @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        
        <div class="form-footer">
          <button type="reset" class="btn btn-secondary">Réinitialiser</button>
          <button type="submit" class="btn btn-primary">
            <i class="material-symbols-rounded">send</i>
            Soumettre le ticket
          </button>
        </div>
      </form>
    </div>
  </div>
  
  <div class="col-lg-4">
    <div class="tips-card">
      <h3 class="tips-title">
        <i class="material-symbols-rounded">lightbulb</i>
        Conseils pour un bon ticket
      </h3>
      
      <ul class="tips-list">
        <li class="tips-item">
          <i class="material-symbols-rounded tips-icon">check_circle</i>
          <span>Utilisez un titre clair et descriptif</span>
        </li>
        <li class="tips-item">
          <i class="material-symbols-rounded tips-icon">check_circle</i>
          <span>Décrivez le problème en détail</span>
        </li>
        <li class="tips-item">
          <i class="material-symbols-rounded tips-icon">check_circle</i>
          <span>Mentionnez les étapes pour reproduire le problème</span>
        </li>
        <li class="tips-item">
          <i class="material-symbols-rounded tips-icon">check_circle</i>
          <span>Indiquez le comportement attendu</span>
        </li>
        <li class="tips-item">
          <i class="material-symbols-rounded tips-icon">check_circle</i>
          <span>Choisissez la bonne priorité selon l'urgence</span>
        </li>
      </ul>
    </div>
    
    <div class="form-card">
      <div class="form-card-header">
        <div class="form-card-icon">
          <i class="material-symbols-rounded">help</i>
        </div>
        <h2 class="form-card-title">Besoin d'aide ?</h2>
      </div>
      
      <div class="form-card-body">
        <p>Si vous avez des questions ou besoin d'assistance pour créer votre ticket, n'hésitez pas à contacter notre équipe de support.</p>
        
        <div class="d-grid gap-2 mt-3">
          <button class="btn btn-primary" id="chatIcon">
            <i class="material-symbols-rounded">chat</i>
            Discuter avec le support
          </button>
          <a href="mailto:support@naftal.com" class="btn btn-secondary">
            <i class="material-symbols-rounded">email</i>
            Envoyer un email
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

