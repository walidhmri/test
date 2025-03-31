@extends('layouts.app')

@section('content')
@push('styles')
<style>
  /* Table styling with dark mode support */
  .table {
    color: var(--text-color);
  }
  
  .table thead th {
    font-size: 0.65rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 0.75rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
    color: var(--text-muted);
  }
  
  .table tbody tr {
    border-bottom: 1px solid var(--border-color);
    transition: all 0.2s ease;
  }
  
  .table tbody tr:hover {
    background-color: var(--hover-bg);
  }
  
  .avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 2px 4px var(--shadow-color);
    border: 2px solid var(--bg-card);
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
  
  .btn-sm {
    padding: 0.4rem 0.8rem;
    font-size: 0.75rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
    margin-right: 0.25rem;
  }
  
  .btn-sm:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px var(--shadow-color);
  }
  
  .bg-gradient-success {
    background: linear-gradient(195deg, #66bb6a 0%, #43a047 100%);
  }
  
  .bg-gradient-warning {
    background: linear-gradient(195deg, #ffa726 0%, #fb8c00 100%);
  }
  
  .bg-gradient-danger {
    background: linear-gradient(195deg, #ef5350 0%, #e53935 100%);
  }
  
  .bg-gradient-info {
    background: linear-gradient(195deg, #26c6da 0%, #00acc1 100%);
  }
  
  .bg-gradient-dark {
    background: linear-gradient(195deg, #42424a 0%, #191919 100%);
  }
  
  .bg-gradient-secondary {
    background: linear-gradient(195deg, #9e9e9e 0%, #757575 100%);
  }
  
  .badge {
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    font-weight: 700;
    border-radius: 0.45rem;
    color: white;
  }
  
  .pagination {
    display: flex;
    justify-content: center;
    margin-top: 1.5rem;
  }
  
  .pagination .page-item .page-link {
    color: var(--text-color);
    background-color: var(--bg-card);
    border: 1px solid var(--border-color);
    margin: 0 0.2rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
  }
  
  .pagination .page-item.active .page-link {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
  }
  
  .pagination .page-item .page-link:hover {
    background-color: var(--hover-bg);
  }
  
  .dark-mode .pagination .page-item .page-link {
    background-color: var(--bg-card);
    color: var(--text-color);
  }
  
  .dark-mode .pagination .page-item.active .page-link {
    background-color: var(--primary-color);
    color: white;
  }
  
  /* Empty state styling */
  .empty-state {
    padding: 2rem;
    text-align: center;
    color: var(--text-muted);
  }
  
  .empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
  }
</style>
@endpush

<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header-gradient shadow-dark border-radius-lg">
        <h6 class="text-white text-capitalize ps-3 mb-0">Tickets existants</h6>
      </div>
      <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
          @if(count($tickets) > 0)
            <table class=" table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="span1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Titre</th>
                  <th class="span1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Priorité</th>
                  <th class="span1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">@lang('messages.date')</th>
                  <th class="span1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                  <th class="span1 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Statut</th>
                </tr>
              </thead>
              <tbody id="ticketList">
                @foreach ($tickets as $ticket)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="span1 mb-0 text-sm">{{ \Illuminate\Support\Str::words($ticket->title, 3, '...') }}</h6>
                          <p class="span1 text-xs text-muted mb-0">ID: #{{ $ticket->id }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <span class="badge 
                          @if($ticket->priority == 'low') bg-gradient-success
                          @elseif($ticket->priority == 'medium') bg-gradient-warning
                          @elseif($ticket->priority == 'high') bg-gradient-danger
                          @elseif($ticket->priority == 'urgent') bg-gradient-dark
                          @else bg-gradient-secondary
                          @endif">
                          {{ ucfirst($ticket->priority) }}
                      </span>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $ticket->created_at->format('d M Y') }}</p>
                      <p class="text-xs text-muted mb-0">{{ $ticket->created_at->format('H:i') }}</p>
                    </td>
                    <td>
                      @php
                      $createdAt = \Carbon\Carbon::parse($ticket->created_at);
                      $now = \Carbon\Carbon::now();
                      $diffInHours = $createdAt->diffInHours($now);
                      @endphp
                  
                      <div class="d-flex">
                        @if($diffInHours < 24)
                          <form action="{{ route('employee.tickets.destroy', $ticket->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm bg-gradient-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce ticket ?')">
                              <i class="material-symbols-rounded">delete</i>
                            </button>
                          </form>
                        @else
                          <button class="btn btn-sm bg-gradient-secondary" disabled title="Vous ne pouvez plus supprimer ce ticket après 24h">
                            <i class="material-symbols-rounded">delete</i>
                          </button>
                        @endif
                        
                        <a href="{{route('employee.tickets.edit', $ticket->id)}}" class="btn btn-sm bg-gradient-info">
                          <i class="material-symbols-rounded">edit</i>
                        </a>
                        
                        <a href="{{route('pdf.ticket',['id'=>$ticket->id])}}" class="btn btn-sm bg-gradient-dark">
                          <i class="material-symbols-rounded">download</i>
                        </a>
                      </div>
                    </td>
                    <td>
                      <span class="badge 
                          @if($ticket->status == 'pending') bg-gradient-warning
                          @elseif($ticket->status == 'solved') bg-gradient-success
                          @elseif($ticket->status == 'in_progress') bg-gradient-info
                          @elseif($ticket->status == 'closed') bg-gradient-secondary
                          @else bg-gradient-dark
                          @endif">
                          {{ $ticket->status }}
                      </span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
              {{ $tickets->links() }}
            </div>
          @else
            <div class="empty-state">
              <i class="material-symbols-rounded">inbox</i>
              <h5>Aucun ticket trouvé</h5>
              <p>Vous n'avez pas encore créé de tickets. Commencez par en créer un nouveau.</p>
              <a href="{{ route('dasboard.tickets') }}" class="btn btn-primary-custom mt-3">
                <i class="material-symbols-rounded me-2">add</i>
                Créer un ticket
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Add hover effect to table rows
    const tableRows = document.querySelectorAll('#ticketList tr');
    tableRows.forEach(row => {
      row.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
        this.style.boxShadow = '0 4px 6px var(--shadow-color)';
      });
      
      row.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = 'none';
      });
    });
  });
</script>
@endpush
@endsection