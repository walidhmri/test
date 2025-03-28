@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Modifier le ticket</h6>
                </div>
            </div>
            <div class="card-body px-4 pb-2">
                <form action="{{ route('employee.ticket.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <!-- Titre -->
                    <div class="mb-3">
                        <label for="title" class="form-label text-xs font-weight-bold">Titre</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $ticket->title) }}" required>
                        @error('title')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Priorité -->
                    <div class="mb-3">
                        <label for="priority" class="form-label text-xs font-weight-bold">Priorité</label>
                        <select name="priority" class="form-control" required>
                            <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                            <option value="urgent" {{ $ticket->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                        @error('priority')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- description-->
                    <div class="mb-3">
                        <label for="description" class="form-label text-xs font-weight-bold">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $ticket->description) }}</textarea>
                        @error('description')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Statut -->
                    
                    <!-- Fichier -->
    

                    <!-- Boutons -->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('employee.tickets.list') }}" class="btn btn-sm bg-gradient-secondary me-2">Annuler</a>
                        <button type="submit" class="btn btn-sm bg-gradient-dark">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection