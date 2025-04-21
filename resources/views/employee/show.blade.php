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

.Ticket-grid {
  display: grid;
  grid-template-columns: 3fr 1fr;
  gap: 1.5rem;
}

@media (max-width: 991.98px) {
  .Ticket-grid {
    grid-template-columns: 1fr;
  }
}

.Ticket-card {
  background-color: var(--bg-card);
  border-radius: 12px;
  box-shadow: 0 2px 12px var(--shadow-color);
  overflow: hidden;
  margin-bottom: 1.5rem;
}

.Ticket-card-header {
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid var(--border-color);
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.Ticket-card-title {
  font-size: 1.125rem;
  font-weight: 600;
  color: var(--text-color);
  margin: 0;
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.Ticket-card-icon {
  color: var(--primary-color);
}

.Ticket-card-body {
  padding: 1.5rem;
}

.Ticket-info {
  margin-bottom: 1.5rem;
}

.Ticket-description {
  margin-bottom: 1.5rem;
  line-height: 1.6;
  color: var(--text-color);
}

.Ticket-meta {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.Ticket-meta-item {
  display: flex;
  flex-direction: column;
}

.Ticket-meta-label {
  font-size: 0.75rem;
  font-weight: 500;
  color: var(--text-muted);
  margin-bottom: 0.25rem;
}

.Ticket-meta-value {
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--text-color);
}

.badge {
  padding: 0.35em 0.65em;
  font-size: 0.75em;
  font-weight: 600;
  border-radius: 6px;
  display: inline-block;
  min-width: 80px;
  text-align: center;
}

.badge-low {
  background-color: rgba(72, 187, 120, 0.1);
  color: var(--success-color);
}

.badge-medium {
  background-color: rgba(246, 173, 85, 0.1);
  color: var(--warning-color);
}

.badge-high {
  background-color: rgba(245, 101, 101, 0.1);
  color: var(--danger-color);
}

.badge-urgent {
  background-color: rgba(26, 32, 44, 0.1);
  color: var(--text-color);
}

.badge-pending {
  background-color: rgba(246, 173, 85, 0.1);
  color: var(--warning-color);
}

.badge-solved {
  background-color: rgba(72, 187, 120, 0.1);
  color: var(--success-color);
}

.badge-in_progress {
  background-color: rgba(66, 153, 225, 0.1);
  color: var(--info-color);
}

.badge-closed {
  background-color: rgba(160, 174, 192, 0.1);
  color: var(--text-muted);
}

.solutions-list {
  margin-bottom: 1.5rem;
}

.solution-item {
  padding: 1.25rem;
  border-radius: 8px;
  background-color: var(--bg-main);
  margin-bottom: 1rem;
  border: 1px solid var(--border-color);
}

.solution-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 0.75rem;
}

.solution-title {
  font-size: 1rem;
  font-weight: 600;
  color: var(--text-color);
  margin: 0;
}

.solution-meta {
  font-size: 0.75rem;
  color: var(--text-muted);
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.solution-content {
  font-size: 0.875rem;
  line-height: 1.6;
  color: var(--text-color);
  margin-bottom: 0.75rem;
}

.solution-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.solution-user {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.solution-avatar {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background-color: var(--primary-light);
  color: var(--primary-color);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 0.75rem;
}

.solution-username {
  font-size: 0.75rem;
  font-weight: 500;
  color: var(--text-color);
}

.solution-actions {
  display: flex;
  gap: 0.5rem;
}

.solution-action {
  width: 28px;
  height: 28px;
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: var(--bg-card);
  color: var(--text-color);
  border: 1px solid var(--border-color);
  cursor: pointer;
  transition: all 0.2s ease;
}

.solution-action:hover {
  background-color: var(--hover-bg);
  color: var(--primary-color);
}

.solution-file {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 0.75rem;
  background-color: var(--bg-card);
  border-radius: 6px;
  margin-bottom: 0.75rem;
  border: 1px solid var(--border-color);
}

.solution-file-icon {
  color: var(--primary-color);
}

.solution-file-name {
  font-size: 0.75rem;
  font-weight: 500;
  color: var(--text-color);
  flex: 1;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.solution-file-action {
  color: var(--primary-color);
  font-size: 1.25rem;
}

.comments-section {
  margin-top: 2rem;
}

.comments-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1rem;
}

.comments-title {
  font-size: 1.125rem;
  font-weight: 600;
  color: var(--text-color);
  margin: 0;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.comments-count {
  background-color: var(--primary-light);
  color: var(--primary-color);
  font-size: 0.75rem;
  font-weight: 600;
  padding: 0.25rem 0.5rem;
  border-radius: 6px;
}

.comments-list {
  margin-bottom: 1.5rem;
}

.comment-item {
  display: flex;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.comment-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: var(--primary-light);
  color: var(--primary-color);
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 1rem;
  flex-shrink: 0;
}

.comment-content {
  flex: 1;
}

.comment-bubble {
  background-color: var(--bg-main);
  border-radius: 12px;
  padding: 1rem;
  margin-bottom: 0.5rem;
  border: 1px solid var(--border-color);
  position: relative;
}

.comment-bubble::before {
  content: '';
  position: absolute;
  top: 12px;
  left: -8px;
  width: 16px;
  height: 16px;
  background-color: var(--bg-main);
  border-left: 1px solid var(--border-color);
  border-bottom: 1px solid var(--border-color);
  transform: rotate(45deg);
}

.comment-text {
  font-size: 0.875rem;
  line-height: 1.6;
  color: var(--text-color);
}

.comment-meta {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 0.75rem;
  color: var(--text-muted);
}

.comment-user {
  font-weight: 500;
}

.comment-time {
  display: flex;
  align-items: center;
  gap: 0.25rem;
}

.comment-form {
  display: flex;
  gap: 1rem;
  margin-top: 1.5rem;
}

.comment-input-wrapper {
  flex: 1;
  position: relative;
}

.comment-input {
  width: 100%;
  padding: 0.75rem 1rem;
  padding-right: 3rem;
  border-radius: 12px;
  border: 1px solid var(--border-color);
  background-color: var(--input-bg);
  color: var(--text-color);
  font-size: 0.875rem;
  resize: none;
  transition: all 0.2s ease;
}

.comment-input:focus {
  outline: none;
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px var(--input-focus-shadow);
}

.comment-submit {
  position: absolute;
  right: 0.5rem;
  bottom: 0.5rem;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background-color: var(--primary-color);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
}

.comment-submit:hover {
  background-color: var(--primary-hover);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(255, 122, 0, 0.3);
}

.Ticket-sidebar-card {
  background-color: var(--bg-card);
  border-radius: 12px;
  box-shadow: 0 2px 12px var(--shadow-color);
  overflow: hidden;
  margin-bottom: 1.5rem;
}

.Ticket-sidebar-header {
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid var(--border-color);
}

.Ticket-sidebar-title {
  font-size: 1.125rem;
  font-weight: 600;
  color: var(--text-color);
  margin: 0;
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.Ticket-sidebar-icon {
  color: var(--primary-color);
}

.Ticket-sidebar-body {
  padding: 1.5rem;
}

.Ticket-actions {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.Ticket-action {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem 1rem;
  border-radius: 8px;
  background-color: var(--bg-main);
  color: var(--text-color);
  font-size: 0.875rem;
  font-weight: 500;
  transition: all 0.2s ease;
  cursor: pointer;
  border: 1px solid var(--border-color);
  text-decoration: none;
}

.Ticket-action:hover {
  background-color: var(--hover-bg);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px var(--shadow-color);
}

.Ticket-action-icon {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  background-color: var(--primary-light);
  color: var(--primary-color);
  display: flex;
  align-items: center;
  justify-content: center;
}

.Ticket-action-text {
  flex: 1;
}

.Ticket-action-arrow {
  color: var(--text-muted);
}

.Ticket-timeline {
  list-style: none;
  padding: 0;
  margin: 0;
  position: relative;
}

.Ticket-timeline::before {
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  left: 16px;
  width: 2px;
  background-color: var(--border-color);
}

.timeline-item {
  position: relative;
  padding-left: 40px;
  padding-bottom: 1.5rem;
}

.timeline-item:last-child {
  padding-bottom: 0;
}

.timeline-icon {
  position: absolute;
  left: 0;
  top: 0;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background-color: var(--primary-light);
  color: var(--primary-color);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1;
}

.timeline-content {
  background-color: var(--bg-main);
  border-radius: 8px;
  padding: 0.75rem 1rem;
  font-size: 0.875rem;
  color: var(--text-color);
  border: 1px solid var(--border-color);
}

.timeline-date {
  font-size: 0.75rem;
  color: var(--text-muted);
  margin-top: 0.25rem;
}

.empty-state {
  padding: 2rem;
  text-align: center;
  color: var(--text-muted);
}

.empty-state-icon {
  font-size: 2.5rem;
  margin-bottom: 1rem;
  color: var(--text-muted);
}

.empty-state-title {
  font-size: 1rem;
  margin-bottom: 0.5rem;
  color: var(--text-color);
}

.empty-state-description {
  margin-bottom: 1rem;
  font-size: 0.875rem;
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
  
  .page-actions .btn {
    flex: 1;
  }
  
  .comment-form {
    flex-direction: column;
  }
  
  .comment-avatar {
    display: none;
  }
}



</style>
@endpush

<div class="page-header">
  <h1 class="page-title">Détails du Ticket #{{ $ticket->id }}</h1>
  <div class="page-actions">
    <a href="{{ route('employee.Tickets.list') }}" class="btn btn-secondary">
      <i class="material-symbols-rounded">arrow_back</i>
      Retour à la liste
    </a>
    <a href="{{ route('employee.Tickets.edit', $ticket->id) }}" class="btn btn-primary">
      <i class="material-symbols-rounded">edit</i>
      Modifier
    </a>
  </div>
</div>

<div class="Ticket-grid">
  <div class="Ticket-main">
    <div class="Ticket-card">
      <div class="Ticket-card-header">
        <h2 class="Ticket-card-title">
          <i class="material-symbols-rounded Ticket-card-icon">confirmation_number</i>
          {{ $ticket->title }}
        </h2>
        <span class="badge badge-{{ $ticket->status }}">
          {{ $ticket->status }}
        </span>
      </div>
      <div class="Ticket-card-body">
        <div class="Ticket-meta">
          <div class="Ticket-meta-item">
            <div class="Ticket-meta-label">Priorité</div>
            <div class="Ticket-meta-value">
              <span class="badge badge-{{ $ticket->priority }}">
                {{ ucfirst($ticket->priority) }}
              </span>
            </div>
          </div>
          <div class="Ticket-meta-item">
            <div class="Ticket-meta-label">Créé le</div>
            <div class="Ticket-meta-value">{{ $ticket->created_at->format('d M Y, H:i') }}</div>
          </div>
          <div class="Ticket-meta-item">
            <div class="Ticket-meta-label">Dernière mise à jour</div>
            <div class="Ticket-meta-value">{{ $ticket->updated_at->format('d M Y, H:i') }}</div>
          </div>
          
          <div class="Ticket-meta-item">
            <div class="Ticket-meta-label">Assigné à</div>
            <div class="Ticket-meta-value">{{ $ticket->user->find($ticket->assign)?->name ?? 'Non assigné' }}
            </div>
          </div>
          
        </div>
        
        <div class="Ticket-info">
          <h3>Description</h3>
          <div class="Ticket-description">
            {{ $ticket->description }}
          </div>
          
          @if($ticket->file)
          <div class="solution-file">
            <i class="material-symbols-rounded solution-file-icon">attach_file</i>
            <span class="solution-file-name">{{ basename($ticket->file) }}</span>
            <a href="{{ asset($ticket->file) }}" download class="solution-file-action">
              <i class="material-symbols-rounded">download</i>
            </a>
          </div>
          @endif
        </div>
      </div>
    </div>
    
    <!-- Solutions Section -->
    <div class="Ticket-card">
      <div class="Ticket-card-header">
        <h2 class="Ticket-card-title">
          <i class="material-symbols-rounded Ticket-card-icon">lightbulb</i>
          Solutions
        </h2>
      </div>
      <div class="Ticket-card-body">
        @if(count($solutions) > 0)
        <div class="solutions-list">
          @foreach($solutions as $solution)
          <div class="solution-item">
            <div class="solution-header">
              <h3 class="solution-title">{{ $solution->title }}</h3>
              <div class="solution-meta">
                <i class="material-symbols-rounded">schedule</i>
                <span>{{ $solution->created_at->format('d M Y, H:i') }}</span>
              </div>
            </div>
            <div id="solution-description">
              {!! $solution->html_description !!}
          </div>
            
            @if($solution->file)
            <div class="solution-file">
              <i class="material-symbols-rounded solution-file-icon">attach_file</i>
              <span class="solution-file-name">{{ basename($solution->file) }}</span>
              <a href="{{ asset($solution->file) }}" download class="solution-file-action">
                <i class="material-symbols-rounded">download</i>
              </a>
            </div>
            @endif
            
            <div class="solution-footer">
              <div class="solution-user">
                <div class="solution-avatar">
                  {{ substr($solution->user->name ?? 'U', 0, 1) }}
                </div>
                <span class="solution-username">{{ $solution->user->name ?? 'Utilisateur' }}</span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @else
        <div class="empty-state">
          <i class="material-symbols-rounded empty-state-icon">lightbulb</i>
          <h3 class="empty-state-title">Aucune solution pour le moment</h3>
          <p class="empty-state-description">Les solutions seront affichées ici une fois qu'elles seront disponibles.</p>
        </div>
        @endif
      </div>
    </div>
    
    <!-- Comments Section -->
    <div class="Ticket-card">
      <div class="Ticket-card-header">
        <h2 class="Ticket-card-title">
          <i class="material-symbols-rounded Ticket-card-icon">chat</i>
          Commentaires
        </h2>
        <div class="comments-count">{{ count($comments) }}</div>
      </div>
      <div class="Ticket-card-body">
        @if(count($comments) > 0)
        <div class="comments-list">
          @foreach($comments as $comment)
          <div class="comment-item">
            <div class="comment-avatar">
              {{ substr($comment->user->name ?? 'U', 0, 1) }}
            </div>
            <div class="comment-content">
              <div class="comment-bubble">
                <div class="comment-text">{{ $comment->content }}</div>
              </div>
              <div class="comment-meta">
                <span class="comment-user">{{ $comment->user->name ?? 'Utilisateur' }}</span>
                <div class="comment-time">
                  <i class="material-symbols-rounded">schedule</i>
                  <span>{{ $comment->created_at->format('d M Y, H:i') }}</span>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @else
        <div class="empty-state">
          <i class="material-symbols-rounded empty-state-icon">chat</i>
          <h3 class="empty-state-title">Aucun commentaire pour le moment</h3>
          <p class="empty-state-description">Soyez le premier à commenter ce Ticket.</p>
        </div>
        @endif
        
        <!-- Comment Form -->
        <form action="{{ route('employee.Tickets.comment', $ticket->id) }}" method="POST" class="comment-form">
          @csrf
          <div class="comment-avatar">
            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
          </div>
          <div class="comment-input-wrapper">
            <textarea name="content" class="comment-input" rows="2" placeholder="Ajouter un commentaire..."></textarea>
            <button type="submit" class="comment-submit">
              <i class="material-symbols-rounded">send</i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <div class="Ticket-sidebar">
    <div class="Ticket-sidebar-card">
      <div class="Ticket-sidebar-header">
        <h3 class="Ticket-sidebar-title">
          <i class="material-symbols-rounded Ticket-sidebar-icon">settings</i>
          Actions
        </h3>
      </div>
      <div class="Ticket-sidebar-body">
        <div class="Ticket-actions">
          <a href="{{ route('employee.Tickets.edit', $ticket->id) }}" class="Ticket-action">
            <div class="Ticket-action-icon">
              <i class="material-symbols-rounded">edit</i>
            </div>
            <span class="Ticket-action-text">Modifier le Ticket</span>
            <i class="material-symbols-rounded Ticket-action-arrow">chevron_right</i>
          </a>
          
          <a href="{{ route('pdf.Ticket', ['id' => $ticket->id]) }}" class="Ticket-action">
            <div class="Ticket-action-icon">
              <i class="material-symbols-rounded">download</i>
            </div>
            <span class="Ticket-action-text">Télécharger en PDF</span>
            <i class="material-symbols-rounded Ticket-action-arrow">chevron_right</i>
          </a>
          
          @if($ticket->created_at->diffInHours(now()) < 24)
          <form action="{{ route('employee.Tickets.destroy', $ticket->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="Ticket-action" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce Ticket ?')">
              <div class="Ticket-action-icon" style="background-color: rgba(245, 101, 101, 0.1); color: var(--danger-color);">
                <i class="material-symbols-rounded">delete</i>
              </div>
              <span class="Ticket-action-text">Supprimer le Ticket</span>
              <i class="material-symbols-rounded Ticket-action-arrow">chevron_right</i>
            </button>
          </form>
          @endif
        </div>
      </div>
    </div>
    
    <div class="Ticket-sidebar-card">
      <div class="Ticket-sidebar-header">
        <h3 class="Ticket-sidebar-title">
          <i class="material-symbols-rounded Ticket-sidebar-icon">history</i>
          Historique
        </h3>
      </div>
      <div class="Ticket-sidebar-body">
        <ul class="Ticket-timeline">
          <li class="timeline-item">
            <div class="timeline-icon">
              <i class="material-symbols-rounded">add_circle</i>
            </div>
            <div class="timeline-content">
              Ticket créé
            </div>
            <div class="timeline-date">{{ $ticket->created_at->format('d M Y, H:i') }}</div>
          </li>
          
          @if($ticket->updated_at->gt($ticket->created_at))
          <li class="timeline-item">
            <div class="timeline-icon">
              <i class="material-symbols-rounded">edit</i>
            </div>
            <div class="timeline-content">
              Ticket mis à jour
            </div>
            <div class="timeline-date">{{ $ticket->updated_at->format('d M Y, H:i') }}</div>
          </li>
          @endif
          
          @if($ticket->status == 'in_progress')
          <li class="timeline-item">
            <div class="timeline-icon">
              <i class="material-symbols-rounded">pending</i>
            </div>
            <div class="timeline-content">
              Ticket en cours de traitement
            </div>
            <div class="timeline-date">{{ $ticket->updated_at->format('d M Y, H:i') }}</div>
          </li>
          @endif
          
          @if($ticket->status == 'solved')
          <li class="timeline-item">
            <div class="timeline-icon">
              <i class="material-symbols-rounded">check_circle</i>
            </div>
            <div class="timeline-content">
              Ticket résolu
            </div>
            <div class="timeline-date">{{ $ticket->updated_at->format('d M Y, H:i') }}</div>
          </li>
          @endif
          
          @if($ticket->status == 'closed')
          <li class="timeline-item">
            <div class="timeline-icon">
              <i class="material-symbols-rounded">cancel</i>
            </div>
            <div class="timeline-content">
              Ticket fermé
            </div>
            <div class="timeline-date">{{ $ticket->updated_at->format('d M Y, H:i') }}</div>
          </li>
          @endif
          
          @foreach($solutions as $solution)
          <li class="timeline-item">
            <div class="timeline-icon">
              <i class="material-symbols-rounded">lightbulb</i>
            </div>
            <div class="timeline-content">
              Solution ajoutée: {{ \Illuminate\Support\Str::limit($solution->title, 30) }}
            </div>
            <div class="timeline-date">{{ $solution->created_at->format('d M Y, H:i') }}</div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Auto-resize textarea
  const commentInput = document.querySelector('.comment-input');
  if (commentInput) {
    commentInput.addEventListener('input', function() {
      this.style.height = 'auto';
      this.style.height = (this.scrollHeight) + 'px';
    });
  }
});
</script>
@endpush
@endsection

