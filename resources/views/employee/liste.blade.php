@extends('layouts.app')

@section('content')
@push('styles')
<style>
/* Table styling with dark mode support */
.Tickets-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1.5rem;
}

.Tickets-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--text-color);
  margin: 0;
}

.Tickets-actions {
  display: flex;
  gap: 0.75rem;
}

.filter-dropdown {
  position: relative;
  display: inline-block;
}

.filter-menu{
  position: absolute;
  right: 0;
  top: calc(100% + 0.5rem);
  width: 320px;
  background-color: var(--bg-card);
  border-radius: 12px;
  box-shadow: 0 4px 20px var(--shadow-color);
  padding: 1.25rem;
  z-index: 1000;
  display: none;
  border: 1px solid var(--border-color);
}

.filter-menu.show {
  display: block;
  animation: fadeIn 0.2s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

.filter-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1rem;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid var(--border-color);
}

.filter-title {
  font-size: 1rem;
  font-weight: 600;
  color: var(--text-color);
  margin: 0;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.filter-close {
  background: transparent;
  border: none;
  color: var(--text-muted);
  cursor: pointer;
  font-size: 1.25rem;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 28px;
  height: 28px;
  border-radius: 6px;
  transition: all 0.2s ease;
}

.filter-close:hover {
  background-color: var(--hover-bg);
  color: var(--primary-color);
}

.filter-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.filter-group {
  margin-bottom: 0.75rem;
}

.filter-label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  font-size: 0.875rem;
  color: var(--text-color);
}

.filter-select,
.filter-input {
  width: 100%;
  padding: 0.625rem 0.875rem;
  border-radius: 8px;
  border: 1px solid var(--border-color);
  background-color: var(--input-bg);
  color: var(--text-color);
  font-size: 0.875rem;
  transition: all 0.2s ease;
}

.filter-select:focus,
.filter-input:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px var(--input-focus-shadow);
  outline: none;
}

.filter-actions {
  display: flex;
  justify-content: space-between;
  margin-top: 1rem;
  padding-top: 1rem;
  border-top: 1px solid var(--border-color);
}

.active-filters {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-top: 1rem;
}

.filter-tag {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.375rem 0.75rem;
  background-color: var(--primary-light);
  color: var(--primary-color);
  border-radius: 6px;
  font-size: 0.75rem;
  font-weight: 500;
}

.filter-tag-remove {
  background: transparent;
  border: none;
  padding: 0;
  margin: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: var(--primary-color);
  font-size: 1rem;
}

.filter-tag-remove:hover {
  color: var(--primary-hover);
}

.table-container {
  background-color: var(--bg-card);
  border-radius: 12px;
  box-shadow: 0 2px 12px var(--shadow-color);
  overflow: hidden;
}

.table-responsive {
  overflow-x: auto;
}

.table {
  width: 100%;
  margin-bottom: 0;
  color: var(--text-color);
  border-collapse: separate;
  border-spacing: 0;
  background-color: transparent;
}

.table th {
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  padding: 1rem 1.5rem;
  border-bottom: 1px solid var(--border-color);
  color: var(--text-muted);
  background-color: transparent;
}

.table td {
  padding: 1rem 1.5rem;
  vertical-align: middle;
  border-bottom: 1px solid var(--border-color);
  background-color: transparent;
}

.table tbody tr {
  transition: all 0.3s ease;
  background-color: transparent;
}

.table tbody tr:hover {
  background-color: var(--hover-bg);
}

.table tbody tr:last-child td {
  border-bottom: none;
}

/* Override Bootstrap table styles */
.table-striped tbody tr:nth-of-type(odd) {
  background-color: transparent;
}

.table-hover tbody tr:hover {
  background-color: var(--hover-bg);
}

/* Badge styling */
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
  background-color: rgba(255, 0, 0, 0.795);
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

/* Action buttons */
.action-buttons {
  display: flex;
  gap: 0.5rem;
}

.action-btn {
  width: 36px;
  height: 36px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  transition: all 0.3s ease;
  border: none;
  cursor: pointer;
  background-color: var(--bg-main);
  color: var(--text-color);
}

.action-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 4px 12px var(--shadow-color);
}

.action-btn.edit-btn:hover {
  background-color: rgba(66, 153, 225, 0.1);
  color: var(--info-color);
}

.action-btn.delete-btn:hover {
  background-color: rgba(245, 101, 101, 0.1);
  color: var(--danger-color);
}

.action-btn.download-btn:hover {
  background-color: var(--primary-light);
  color: var(--primary-color);
}

.action-btn.disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.action-btn.disabled:hover {
  transform: none;
  box-shadow: none;
}

/* Ticket info */
.Ticket-title {
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--text-color);
  margin-bottom: 0.25rem;
}

.Ticket-id {
  font-size: 0.75rem;
  color: var(--text-muted);
}

.Ticket-date {
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--text-color);
  margin-bottom: 0.25rem;
}

.Ticket-time {
  font-size: 0.75rem;
  color: var(--text-muted);
}

/* Empty state */
.empty-state {
  padding: 3rem;
  text-align: center;
  color: var(--text-muted);
}

.empty-state-icon {
  font-size: 3rem;
  margin-bottom: 1.5rem;
  color: var(--text-muted);
}

.empty-state-title {
  font-size: 1.25rem;
  margin-bottom: 1rem;
  color: var(--text-color);
}

.empty-state-description {
  margin-bottom: 1.5rem;
  max-width: 500px;
  margin-left: auto;
  margin-right: auto;
}

/* Pagination */
.pagination-container {
  display: flex;
  justify-content: center;
  margin-top: 1.5rem;
  padding: 1rem;
}

/* Override Laravel pagination styles */
.pagination {
  display: flex;
  list-style: none;
  padding: 0;
  margin: 0;
  gap: 0.5rem;
}

.pagination li {
  margin: 0;
}

.pagination li a,
.pagination li span {
  display: flex;
  align-items: center;
  justify-content: center;
  min-width: 2.5rem;
  height: 2.5rem;
  padding: 0.5rem 0.75rem;
  border-radius: 8px;
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--text-color);
  background-color: var(--bg-card);
  border: 1px solid var(--border-color);
  transition: all 0.3s ease;
  text-decoration: none;
}

.pagination li a:hover {
  background-color: var(--hover-bg);
  color: var(--primary-color);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px var(--shadow-color);
}

.pagination li.active span {
  background-color: var(--primary-color);
  color: white;
  border-color: var(--primary-color);
  box-shadow: 0 4px 12px rgba(255, 122, 0, 0.3);
}

.pagination li.disabled span {
  color: var(--text-muted);
  pointer-events: none;
  background-color: var(--bg-card);
  border-color: var(--border-color);
}

/* Custom tooltip */
.tooltip-container {
  position: fixed;
  z-index: 9999;
  padding: 0.5rem 0.75rem;
  background-color: var(--bg-card);
  color: var(--text-color);
  border-radius: 6px;
  font-size: 0.75rem;
  box-shadow: 0 4px 12px var(--shadow-color);
  pointer-events: none;
  opacity: 0;
  transition: opacity 0.2s ease;
}

/* Responsive adjustments */
@media (max-width: 991.98px) {
  .Tickets-actions {
    flex-wrap: wrap;
  }
  
  .filter-menu {
    width: 280px;
  }
}

@media (max-width: 767.98px) {
  .Tickets-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }
  
  .Tickets-actions {
    width: 100%;
  }
  
  .Tickets-actions .btn {
    flex: 1;
  }
  
  .filter-menu {
    width: 100%;
    position: fixed;
    top: auto;
    bottom: 0;
    left: 0;
    right: 0;
    border-radius: 12px 12px 0 0;
    max-height: 80vh;
    overflow-y: auto;
  }
  
  .table-container {
    border-radius: 8px;
  }
  
  .table {
    display: block;
  }
  
  .table thead {
    display: none;
  }
  
  .table tbody {
    display: block;
  }
  
  .table tbody tr {
    display: block;
    margin-bottom: 1rem;
    border-radius: 8px;
    background-color: var(--bg-card);
    box-shadow: 0 2px 5px var(--shadow-color);
    padding: 1rem;
  }
  
  .table tbody td {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border: none;
    padding: 0.5rem 0;
    text-align: right;
  }
  
  .table tbody td:before {
    content: attr(data-label);
    font-weight: 600;
    margin-right: 1rem;
    text-align: left;
    color: var(--text-color);
  }
  
  .table tbody td:not(:last-child) {
    border-bottom: 1px solid var(--border-color);
  }
  
  .action-buttons {
    justify-content: flex-end;
    width: 100%;
  }
  
  .pagination li:not(.active):not(:first-child):not(:last-child) {
    display: none;
  }
  
  .pagination li.active {
    flex: 1;
  }
  
  .pagination li.active span {
    justify-content: center;
  }
}
</style>
@endpush
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Filter dropdown functionality
    const filterButton = document.getElementById('filterButton');
    const filterMenu = document.getElementById('filterMenu');
    const filterClose = document.getElementById('filterClose');

    // زر التبديل بين الإظهار والإخفاء
    filterButton.addEventListener('click', function(event) {
      event.stopPropagation(); // لمنع إغلاق القائمة فور النقر
      if (filterMenu.style.display === "none" || filterMenu.style.display === "") {
        filterMenu.style.display = "block";
      } else {
        filterMenu.style.display = "none";
      }
    });

    // زر الإغلاق داخل الفلتر
    filterClose.addEventListener('click', function() {
      filterMenu.style.display = "none";
    });

    // إغلاق القائمة عند النقر خارجها
    document.addEventListener('click', function(event) {
      if (!filterMenu.contains(event.target) && !filterButton.contains(event.target)) {
        filterMenu.style.display = "none";
      }
    });

    // Custom tooltip functionality
    const tooltipElements = document.querySelectorAll('[data-tooltip]');
    let tooltipContainer = null;

    function createTooltip() {
      tooltipContainer = document.createElement('div');
      tooltipContainer.className = 'tooltip-container';
      document.body.appendChild(tooltipContainer);
    }

    function showTooltip(element, text) {
      if (!tooltipContainer) {
        createTooltip();
      }

      tooltipContainer.textContent = text;
      tooltipContainer.style.opacity = '1';

      const rect = element.getBoundingClientRect();
      const tooltipWidth = tooltipContainer.offsetWidth;
      const tooltipHeight = tooltipContainer.offsetHeight;

      // تحديد موقع التولتيب
      let top = rect.top - tooltipHeight - 8;
      let left = rect.left + (rect.width / 2) - (tooltipWidth / 2);

      // التأكد من بقاء التولتيب داخل الشاشة
      if (top < 10) {
        top = rect.bottom + 8;
      }
      if (left < 10) {
        left = 10;
      } else if (left + tooltipWidth > window.innerWidth - 10) {
        left = window.innerWidth - tooltipWidth - 10;
      }

      tooltipContainer.style.top = `${top}px`;
      tooltipContainer.style.left = `${left}px`;
    }

    function hideTooltip() {
      if (tooltipContainer) {
        tooltipContainer.style.opacity = '0';
      }
    }

    tooltipElements.forEach(element => {
      element.addEventListener('mouseenter', function() {
        const tooltipText = this.getAttribute('data-tooltip');
        if (tooltipText) {
          showTooltip(this, tooltipText);
        }
      });

      element.addEventListener('mouseleave', hideTooltip);

      element.addEventListener('focus', function() {
        const tooltipText = this.getAttribute('data-tooltip');
        if (tooltipText) {
          showTooltip(this, tooltipText);
        }
      });

      element.addEventListener('blur', hideTooltip);
    });
  });
</script>

<div class="Tickets-header">
  <h1 class="Tickets-title">Tickets existants</h1>
  <div class="Tickets-actions">
    <a href="{{ route('dasboard.Tickets') }}" class="btn btn-primary">
      <i class="material-symbols-rounded">add</i>
      Nouveau Ticket
    </a>
    <div class="filter-dropdown">
      <button class="btn btn-outline-primary" id="filterButton">
        <i class="material-symbols-rounded">filter_list</i>
        Filtrer
      </button>
      <div class="filter-menu" id="filterMenu">
        <div class="filter-header">
          <h3 class="filter-title">
            <i class="material-symbols-rounded">filter_alt</i>
            Filtrer les Tickets
          </h3>
          <button class="filter-close" id="filterClose">
            <i class="material-symbols-rounded">close</i>
          </button>
        </div>
        <form action="{{ route('employee.Tickets.list') }}" method="GET" class="filter-form">
          <div class="filter-group">
            <label for="search" class="filter-label">Rechercher par titre</label>
            <input type="text" id="search" name="search" class="filter-input" placeholder="Rechercher..." value="{{ request('search') }}">
          </div>
          
          <div class="filter-group">
            <label for="status" class="filter-label">Statut</label>
            <select id="status" name="status" class="filter-select">
              <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>Tous les statuts</option>
              <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
              <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>En cours</option>
              <option value="solved" {{ request('status') == 'solved' ? 'selected' : '' }}>Résolu</option>
              <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Fermé</option>
            </select>
          </div>
          
          <div class="filter-group">
            <label for="priority" class="filter-label">Priorité</label>
            <select id="priority" name="priority" class="filter-select">
              <option value="all" {{ request('priority') == 'all' || !request('priority') ? 'selected' : '' }}>Toutes les priorités</option>
              <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Basse</option>
              <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Moyenne</option>
              <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Haute</option>
              <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgente</option>
            </select>
          </div>
          
          <div class="filter-group">
            <label for="sort_order" class="filter-label">Trier par</label>
            <select id="sort_order" name="sort_order" class="filter-select">
              <option value="desc" {{ request('sort_order') == 'desc' || !request('sort_order') ? 'selected' : '' }}>Plus récent d'abord</option>
              <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Plus ancien d'abord</option>
            </select>
            <input type="hidden" name="sort_field" value="created_at">
          </div>
          
          <div class="filter-actions">
            <a href="{{ route('employee.Tickets.list') }}" class="btn btn-secondary">Réinitialiser</a>
            <button type="submit" class="btn btn-primary">Appliquer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@if(request()->anyFilled(['search', 'status', 'priority', 'sort_order']) && request('status') != 'all' && request('priority') != 'all')
<div class="active-filters">
  @if(request('search'))
    <div class="filter-tag">
      Recherche: {{ request('search') }}
      <a href="{{ request()->fullUrlWithoutQuery(['search']) }}" class="filter-tag-remove">
        <i class="material-symbols-rounded">close</i>
      </a>
    </div>
  @endif
  
  @if(request('status') && request('status') != 'all')
    <div class="filter-tag">
      Statut: {{ request('status') == 'pending' ? 'En attente' : (request('status') == 'in_progress' ? 'En cours' : (request('status') == 'solved' ? 'Résolu' : 'Fermé')) }}
      <a href="{{ request()->fullUrlWithoutQuery(['status']) }}" class="filter-tag-remove">
        <i class="material-symbols-rounded">close</i>
      </a>
    </div>
  @endif
  
  @if(request('priority') && request('priority') != 'all')
    <div class="filter-tag">
      Priorité: {{ request('priority') == 'low' ? 'Basse' : (request('priority') == 'medium' ? 'Moyenne' : (request('priority') == 'high' ? 'Haute' : 'Urgente')) }}
      <a href="{{ request()->fullUrlWithoutQuery(['priority']) }}" class="filter-tag-remove">
        <i class="material-symbols-rounded">close</i>
      </a>
    </div>
  @endif
  
  @if(request('sort_order'))
    <div class="filter-tag">
      Tri: {{ request('sort_order') == 'desc' ? 'Plus récent d\'abord' : 'Plus ancien d\'abord' }}
      <a href="{{ request()->fullUrlWithoutQuery(['sort_order']) }}" class="filter-tag-remove">
        <i class="material-symbols-rounded">close</i>
      </a>
    </div>
  @endif
  
  <a href="{{ route('employee.Tickets.list') }}" class="filter-tag">
    Effacer tous les filtres
    <i class="material-symbols-rounded">backspace</i>
  </a>
</div>
@endif

<div class="table-container">
@if(count($tickets) > 0)
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Titre</th>
          <th>Priorité</th>
          <th>Assigned to</th>
          <th>@lang('messages.date')</th>
          <th>Statut</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="TicketList">
        @foreach ($tickets as $ticket)
          <tr>
            <td data-label="Titre">
              <div class="Ticket-info">
                <div class="Ticket-title">{{ \Illuminate\Support\Str::words($ticket->title, 5, '...') }}</div>
                <div class="Ticket-id">ID: #{{ $ticket->id }}</div>
              </div>
            </td>
            <td data-label="Priorité">
              <span class="badge badge-{{ $ticket->priority }}">
                {{ ucfirst($ticket->priority) }}
              </span>
            </td>
            <td data-label="Titre">
              <div class="Ticket-info">
                <div class="Ticket-title">
                  @php
                  $assignedUser = $ticket->user->find($ticket->assign);
                  echo $assignedUser ? $assignedUser->name : 'Non assigné';
              @endphp
                </div>
              </div>
            </td>
          </td>
            <td data-label="Date">
              <div class="Ticket-date">{{ $ticket->created_at->format('d M Y') }}</div>
              <div class="Ticket-time">{{ $ticket->created_at->format('H:i') }}</div>
            </td>
            <td data-label="Statut">
              <span class="badge badge-{{ $ticket->status }}">
                {{ $ticket->status }}
              </span>
            </td>
            <td data-label="Action">
              @php
              $createdAt = \Carbon\Carbon::parse($ticket->created_at);
              $now = \Carbon\Carbon::now();
              $diffInHours = $createdAt->diffInHours($now);
              @endphp
          
              <div class="action-buttons">
                @if($diffInHours < 24)
                  <form action="{{ route('employee.Tickets.destroy', $ticket->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn delete-btn" data-tooltip="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce Ticket ?')">
                      <i class="material-symbols-rounded">delete</i>
                    </button>
                  </form>
                @else
                  <button class="action-btn disabled" disabled data-tooltip="Vous ne pouvez plus supprimer ce Ticket après 24h">
                    <i class="material-symbols-rounded">delete</i>
                  </button>
                @endif
                
                <a href="{{route('employee.Tickets.edit', $ticket->id)}}" class="action-btn edit-btn" data-tooltip="Modifier">
                  <i class="material-symbols-rounded">edit</i>
                </a>
                <a href="{{ route('employee.Tickets.show', $ticket->id) }}" class="action-btn show-btn" data-tooltip="Afficher">
                  <i class="material-symbols-rounded">visibility</i>
                </a>
                
                <a href="{{route('pdf.Ticket',['id'=>$ticket->id])}}" class="action-btn download-btn" data-tooltip="Télécharger">
                  <i class="material-symbols-rounded">download</i>
                </a>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @php
  $currentPage = $tickets->currentPage(); // الصفحة الحالية
  $totalPages = $tickets->lastPage(); // إجمالي الصفحات
@endphp

<nav>
  <ul class="pagination justify-content-center">
      <!-- زر السابق -->
      <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
          <a class="page-link" href="{{ $tickets->previousPageUrl() }}" tabindex="-1">« Previous</a>
      </li>

      <!-- أرقام الصفحات -->
      @for ($i = 1; $i <= $totalPages; $i++)
          <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
              <a class="page-link" href="{{ $tickets->url($i) }}">{{ $i }}</a>
          </li>
      @endfor

      <!-- زر التالي -->
      <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
          <a class="page-link" href="{{ $tickets->nextPageUrl() }}">Next »</a>
      </li>
  </ul>
</nav>
@else
  <div class="empty-state">
    <i class="material-symbols-rounded empty-state-icon">inbox</i>
    <h2 class="empty-state-title">Aucun Ticket trouvé</h2>
    <p class="empty-state-description">
      @if(request()->anyFilled(['search', 'status', 'priority']))
        Aucun Ticket ne correspond à vos critères de recherche. Essayez de modifier vos filtres.
      @else
        Vous n'avez pas encore créé de Tickets. Commencez par en créer un nouveau.
      @endif
    </p>
    @if(request()->anyFilled(['search', 'status', 'priority']))
      <a href="{{ route('employee.Tickets.list') }}" class="btn btn-primary">
        <i class="material-symbols-rounded">filter_alt_off</i>
        Effacer les filtres
      </a>
    @else
      <a href="{{ route('dasboard.Tickets') }}" class="btn btn-primary">
        <i class="material-symbols-rounded">add</i>
        Créer un Ticket
      </a>
    @endif
  </div>
@endif
</div>



@endsection

