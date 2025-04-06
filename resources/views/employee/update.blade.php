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
  <h1 class="page-title">Modifier le ticket</h1>
  <div class="page-actions">
    <a href="{{ route('employee.tickets.list') }}" class="btn btn-secondary">
      <i class="material-symbols-rounded">arrow_back</i>
      Retour à la liste
    </a>
  </div>
</div>

<div class="form-card">
  <div class="form-card-header">
    <div class="form-card-icon">
      <i class="material-symbols-rounded">edit_document</i>
    </div>
    <h2 class="form-card-title">Informations du ticket</h2>
  </div>
  
  <form action="{{ route('employee.tickets.update', $ticket->id) }}" method="POST">
    @csrf
    @method('patch')
    
    <div class="form-card-body">
      <div class="form-group">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $ticket->title) }}" required>
        @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      
      <div class="form-group">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $ticket->description) }}</textarea>
        @error('description')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="priority" class="form-label">Priorité</label>
            <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority" required>
              <option value="low" {{ old('priority', $ticket->priority) == 'low' ? 'selected' : '' }}>Basse</option>
              <option value="medium" {{ old('priority', $ticket->priority) == 'medium' ? 'selected' : '' }}>Moyenne</option>
              <option value="high" {{ old('priority', $ticket->priority) == 'high' ? 'selected' : '' }}>Haute</option>
              <option value="urgent" {{ old('priority', $ticket->priority) == 'urgent' ? 'selected' : '' }}>Urgente</option>
            </select>
            @error('priority')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        
   
      </div>
    </div>
    
    <div class="form-footer">
      <a href="{{ url()->previous() ?? route('employee.tickets.list') }}" class="btn btn-secondary">Annuler</a>
      <button type="submit" class="btn btn-primary">
        <i class="material-symbols-rounded">save</i>
        Enregistrer les modifications
      </button>
    </div>
  </form>
</div>

@if($ticket->created_at->diffInHours(now()) < 24)
<div class="form-card">
  <div class="form-card-header">
    <div class="form-card-icon" style="background-color: rgba(245, 101, 101, 0.1); color: var(--danger-color);">
      <i class="material-symbols-rounded">delete</i>
    </div>
    <h2 class="form-card-title">Supprimer le ticket</h2>
  </div>
  
  <div class="form-card-body">
    <p>Attention, cette action est irréversible. Le ticket sera définitivement supprimé.</p>
    <p class="form-text">Vous ne pouvez supprimer un ticket que dans les 24 heures suivant sa création.</p>
  </div>
  
  <div class="form-footer">
    <form action="{{ route('employee.tickets.destroy', $ticket->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce ticket ?')">
        <i class="material-symbols-rounded">delete</i>
        Supprimer le ticket
      </button>
    </form>
  </div>
</div>
@endif
@endsection
