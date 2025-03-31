@extends('layouts.app')

@section('content')
@push('styles')
<style>
  /* Form styling with dark mode support */
  .form-control {
    background-color: var(--bg-card);
    color: var(--text-color);
    border: 1px solid var(--border-color);
    transition: all 0.3s ease;
  }
  
  .form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.25);
  }
  
  .form-label {
    color: var(--text-color);
    font-weight: 500;
  }
  
  .border-custom {
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
  }
  
  .card-header-gradient {
    background: linear-gradient(195deg, #42424a 0%, #191919 100%);
    margin-top: -24px;
    margin-bottom: 16px;
    padding: 16px;
    border-radius: 0.75rem;
    box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14);
  }
  
  .dark-mode .card-header-gradient {
    background: linear-gradient(195deg, #303038 0%, #1a1a1a 100%);
  }
  
  .form-control-file {
    padding: 0.5rem;
    background-color: var(--bg-card);
    color: var(--text-color);
    border-radius: 0.5rem;
    border: 1px solid var(--border-color);
    width: 100%;
  }
  
  .btn-primary-custom {
    background: linear-gradient(195deg, #ec407a 0%, #d81b60 100%);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(233, 30, 99, 0.2);
  }
  
  .btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 7px 14px rgba(233, 30, 99, 0.3);
  }
  
  .file-upload-container {
    margin-top: 1rem;
    padding: 1rem;
    border: 1px dashed var(--border-color);
    border-radius: 0.5rem;
    background-color: var(--bg-card);
    transition: all 0.3s ease;
  }
  
  .file-upload-container:hover {
    border-color: var(--primary-color);
  }
</style>
@endpush

<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header-gradient shadow-dark border-radius-lg">
        <h6 class="text-white text-capitalize ps-3 mb-0">Créer un nouveau ticket</h6>
      </div>

      <div class="card-body px-4 pb-2">
        <form id="ticketForm" method="post" action="{{route('employee.tickets.add')}}" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="title" class="form-control border-custom" id="ticketTitle" placeholder="Entrez le titre du ticket" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control border-custom" id="ticketDescription" rows="3" placeholder="Décrivez le problème" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Priorité</label>
            <select name="priority" class="form-control border-custom" id="ticketPriority" required>
              <option value="">Sélectionnez une priorité</option>
              <option value="low">Basse</option>
              <option value="medium">Moyenne</option>
              <option value="high">Haute</option>
              <option value="urgent">Urgente</option>
            </select>
          </div>
          <div class="file-upload-container">
            <label for="file" class="form-label">Pièce jointe (si nécessaire)</label>
            <input type="file" name="file" class="form-control-file border-custom" id="file">
            <small class="text-muted">Formats acceptés: PDF, JPG, PNG (max 5MB)</small>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn btn-primary-custom">
              <i class="material-symbols-rounded me-2">send</i>
              Envoyer le ticket
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection