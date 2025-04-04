@extends('layouts.app')

@section('content')
@push('styles')
<style>
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
  }
  
  .stat-card {
    background-color: var(--bg-card);
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 12px var(--shadow-color);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
  }
  
  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px var(--shadow-color);
  }
  
  .stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.5rem;
  }
  
  .stat-icon.primary {
    background-color: var(--primary-light);
    color: var(--primary-color);
  }
  
  .stat-icon.success {
    background-color: rgba(72, 187, 120, 0.1);
    color: var(--success-color);
  }
  
  .stat-icon.warning {
    background-color: rgba(246, 173, 85, 0.1);
    color: var(--warning-color);
  }
  
  .stat-icon.danger {
    background-color: rgba(245, 101, 101, 0.1);
    color: var(--danger-color);
  }
  
  .stat-info {
    flex: 1;
  }
  
  .stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-color);
    margin-bottom: 0.25rem;
  }
  
  .stat-label {
    font-size: 0.875rem;
    color: var(--text-muted);
  }
  
  .stat-change {
    font-size: 0.75rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    margin-top: 0.25rem;
  }
  
  .stat-change.up {
    color: var(--success-color);
  }
  
  .stat-change.down {
    color: var(--danger-color);
  }
  
  .stat-change-icon {
    font-size: 1rem;
    margin-right: 0.25rem;
  }
  
  .chart-card {
    background-color: var(--bg-card);
    border-radius: 12px;
    box-shadow: 0 2px 12px var(--shadow-color);
    overflow: hidden;
    margin-bottom: 1.5rem;
  }
  
  .chart-card-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  
  .chart-card-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-color);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  
  .chart-card-icon {
    color: var(--primary-color);
  }
  
  .chart-card-actions {
    display: flex;
    gap: 0.5rem;
  }
  
  .chart-card-action {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--bg-main);
    color: var(--text-color);
    border: 1px solid var(--border-color);
    cursor: pointer;
    transition: all 0.3s ease;
  }
  
  .chart-card-action:hover {
    background-color: var(--hover-bg);
    color: var(--primary-color);
  }
  
  .chart-card-body {
    padding: 1.5rem;
  }
  
  .chart-container {
    position: relative;
    height: 300px;
  }
  
  .recent-tickets {
    background-color: var(--bg-card);
    border-radius: 12px;
    box-shadow: 0 2px 12px var(--shadow-color);
    overflow: hidden;
  }
  
  .recent-tickets-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  
  .recent-tickets-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-color);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  
  .recent-tickets-icon {
    color: var(--primary-color);
  }
  
  .recent-tickets-action {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--primary-color);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
  }
  
  .recent-tickets-action:hover {
    color: var(--primary-hover);
    text-decoration: underline;
  }
  
  .ticket-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  .ticket-item {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
    transition: all 0.3s ease;
  }
  
  .ticket-item:last-child {
    border-bottom: none;
  }
  
  .ticket-item:hover {
    background-color: var(--hover-bg);
  }
  
  .ticket-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.5rem;
  }
  
  .ticket-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-color);
    margin: 0;
  }
  
  .ticket-badge {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 6px;
    display: inline-block;
  }
  
  .ticket-badge-low {
    background-color: rgba(72, 187, 120, 0.1);
    color: var(--success-color);
  }
  
  .ticket-badge-medium {
    background-color: rgba(246, 173, 85, 0.1);
    color: var(--warning-color);
  }
  
  .ticket-badge-high {
    background-color: rgba(245, 101, 101, 0.1);
    color: var(--danger-color);
  }
  
  .ticket-badge-urgent {
    background-color: rgba(26, 32, 44, 0.1);
    color: var(--text-color);
  }
  
  .ticket-badge-pending {
    background-color: rgba(246, 173, 85, 0.1);
    color: var(--warning-color);
  }
  
  .ticket-badge-solved {
    background-color: rgba(72, 187, 120, 0.1);
    color: var(--success-color);
  }
  
  .ticket-badge-in_progress {
    background-color: rgba(66, 153, 225, 0.1);
    color: var(--info-color);
  }
  
  .ticket-badge-closed {
    background-color: rgba(160, 174, 192, 0.1);
    color: var(--text-muted);
  }
  
  .ticket-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  
  .ticket-meta-item {
    font-size: 0.75rem;
    color: var(--text-muted);
    display: flex;
    align-items: center;
    gap: 0.25rem;
  }
  
  .ticket-meta-icon {
    font-size: 1rem;
  }
  
  .quick-actions {
    background-color: var(--bg-card);
    border-radius: 12px;
    box-shadow: 0 2px 12px var(--shadow-color);
    overflow: hidden;
  }
  
  .quick-actions-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
  }
  
  .quick-actions-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-color);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }
  
  .quick-actions-icon {
    color: var(--primary-color);
  }
  
  .quick-actions-body {
    padding: 1.5rem;
  }
  
  .action-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
  }
  
  .action-card {
    background-color: var(--bg-main);
    border-radius: 8px;
    padding: 1.25rem;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    border: 1px solid var(--border-color);
  }
  
  .action-card:hover {
    background-color: var(--hover-bg);
    transform: translateY(-3px);
    box-shadow: 0 4px 12px var(--shadow-color);
  }
  
  .action-icon {
    width: 48px;
    height: 48px;
    border-radius: 24px;
    background-color: var(--primary-light);
    color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.75rem;
    font-size: 1.5rem;
  }
  
  .action-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-color);
    margin: 0;
  }
  
  @media (max-width: 767.98px) {
    .action-grid {
      grid-template-columns: 1fr;
    }
  }
</style>
@endpush

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon primary">
      <i class="material-symbols-rounded">confirmation_number</i>
    </div>
    <div class="stat-info">
      <div class="stat-value">{{ $tickets->count() ?? 0 }}</div>
      <div class="stat-label">Total des tickets</div>
      <div class="stat-change up">
        <i class="material-symbols-rounded stat-change-icon">trending_up</i>
        <span>12% ce mois</span>
      </div>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon warning">
      <i class="material-symbols-rounded">pending</i>
    </div>
    <div class="stat-info">
      <div class="stat-value">{{ $tickets->where('status', 'pending')->count() ?? 0 }}</div>
      <div class="stat-label">Tickets en attente</div>
      <div class="stat-change down">
        <i class="material-symbols-rounded stat-change-icon">trending_down</i>
        <span>5% ce mois</span>
      </div>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon success">
      <i class="material-symbols-rounded">task_alt</i>
    </div>
    <div class="stat-info">
      <div class="stat-value">{{ $tickets->where('status', 'solved')->count() ?? 0 }}</div>
      <div class="stat-label">Tickets résolus</div>
      <div class="stat-change up">
        <i class="material-symbols-rounded stat-change-icon">trending_up</i>
        <span>18% ce mois</span>
      </div>
    </div>
  </div>
  
  <div class="stat-card">
    <div class="stat-icon danger">
      <i class="material-symbols-rounded">priority_high</i>
    </div>
    <div class="stat-info">
      <div class="stat-value">{{ $tickets->where('priority', 'urgent')->count() ?? 0 }}</div>
      <div class="stat-label">Tickets urgents</div>
      <div class="stat-change down">
        <i class="material-symbols-rounded stat-change-icon">trending_down</i>
        <span>3% ce mois</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="chart-card mb-4">
      <div class="chart-card-header">
        <h2 class="chart-card-title">
          <i class="material-symbols-rounded chart-card-icon">analytics</i>
          Activité des tickets
        </h2>
        <div class="chart-card-actions">
          <button class="chart-card-action">
            <i class="material-symbols-rounded">download</i>
          </button>
          <button class="chart-card-action">
            <i class="material-symbols-rounded">more_vert</i>
          </button>
        </div>
      </div>
      <div class="chart-card-body">
        <div class="chart-container">
          <canvas id="ticketsChart"></canvas>
        </div>
      </div>
    </div>
    
    <div class="recent-tickets">
      <div class="recent-tickets-header">
        <h2 class="recent-tickets-title">
          <i class="material-symbols-rounded recent-tickets-icon">receipt_long</i>
          Tickets récents
        </h2>
        <a href="{{ route('employee.tickets.list') }}" class="recent-tickets-action">
          <span>Voir tous</span>
          <i class="material-symbols-rounded">arrow_forward</i>
        </a>
      </div>
      
      <ul class="ticket-list">
        @forelse($tickets->take(5) as $ticket)
          <li class="ticket-item">
            <div class="ticket-header">
              <h3 class="ticket-title">{{ \Illuminate\Support\Str::limit($ticket->title, 50) }}</h3>
              <span class="ticket-badge ticket-badge-{{ $ticket->priority }}">
                {{ ucfirst($ticket->priority) }}
              </span>
            </div>
            <div class="ticket-meta">
              <div class="ticket-meta-item">
                <i class="material-symbols-rounded ticket-meta-icon">schedule</i>
                <span>{{ $ticket->created_at->diffForHumans() }}</span>
              </div>
              <div class="ticket-meta-item">
                <i class="material-symbols-rounded ticket-meta-icon">label</i>
                <span class="ticket-badge ticket-badge-{{ $ticket->status }}">{{ $ticket->status }}</span>
              </div>
              <div class="ticket-meta-item">
                <i class="material-symbols-rounded ticket-meta-icon">tag</i>
                <span>#{{ $ticket->id }}</span>
              </div>
            </div>
          </li>
        @empty
          <li class="ticket-item">
            <div class="text-center py-4">
              <i class="material-symbols-rounded" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;">inbox</i>
              <p>Aucun ticket récent trouvé</p>
              <a href="{{ route('dasboard.tickets') }}" class="btn btn-primary btn-sm mt-2">
                <i class="material-symbols-rounded">add</i>
                Créer un ticket
              </a>
            </div>
          </li>
        @endforelse
      </ul>
    </div>
  </div>
  
  <div class="col-lg-4">
    <div class="quick-actions mb-4">
      <div class="quick-actions-header">
        <h2 class="quick-actions-title">
          <i class="material-symbols-rounded quick-actions-icon">bolt</i>
          Actions rapides
        </h2>
      </div>
      
      <div class="quick-actions-body">
        <div class="action-grid">
          <a href="{{ route('dasboard.tickets') }}" class="action-card">
            <div class="action-icon">
              <i class="material-symbols-rounded">add</i>
            </div>
            <h3 class="action-title">Nouveau ticket</h3>
          </a>
          
          <a href="{{ route('employee.tickets.list') }}" class="action-card">
            <div class="action-icon">
              <i class="material-symbols-rounded">list</i>
            </div>
            <h3 class="action-title">Mes tickets</h3>
          </a>
          
          <a href="{{ route('employee.profile.edit') }}" class="action-card">
            <div class="action-icon">
              <i class="material-symbols-rounded">person</i>
            </div>
            <h3 class="action-title">Mon profil</h3>
          </a>
          
          <div class="action-card" id="chatIcon">
            <div class="action-icon">
              <i class="material-symbols-rounded">support_agent</i>
            </div>
            <h3 class="action-title">Support</h3>
          </div>
        </div>
      </div>
    </div>
    
    <div class="chart-card">
      <div class="chart-card-header">
        <h2 class="chart-card-title">
          <i class="material-symbols-rounded chart-card-icon">pie_chart</i>
          Répartition par statut
        </h2>
      </div>
      <div class="chart-card-body">
        <div class="chart-container" style="height: 250px;">
          <canvas id="statusChart"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Tickets Activity Chart
    const ticketsCtx = document.getElementById('ticketsChart').getContext('2d');
    const isDarkMode = document.body.classList.contains('dark-mode');
    const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
    const textColor = isDarkMode ? '#e2e8f0' : '#2c3e50';
    
    const ticketsChart = new Chart(ticketsCtx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
        datasets: [
          {
            label: 'Tickets créés',
            data: [12, 19, 15, 17, 14, 25, 22, 20, 24, 28, 25, 30],
            borderColor: '#FF7A00',
            backgroundColor: 'rgba(255, 122, 0, 0.1)',
            tension: 0.4,
            fill: true
          },
          {
            label: 'Tickets résolus',
            data: [8, 15, 12, 14, 10, 20, 18, 16, 19, 22, 20, 25],
            borderColor: '#48BB78',
            backgroundColor: 'rgba(72, 187, 120, 0.1)',
            tension: 0.4,
            fill: true
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: gridColor
            },
            ticks: {
              color: textColor
            }
          },
          x: {
            grid: {
              color: gridColor
            },
            ticks: {
              color: textColor
            }
          }
        },
        plugins: {
          legend: {
            labels: {
              color: textColor
            }
          }
        }
      }
    });
    
    // Status Distribution Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    
    const statusChart = new Chart(statusCtx, {
      type: 'doughnut',
      data: {
        labels: ['En attente', 'En cours', 'Résolu', 'Fermé'],
        datasets: [{
          data: [
            {{ $tickets->where('status', 'pending')->count() ?? 0 }}, 
            {{ $tickets->where('status', 'in_progress')->count() ?? 0 }}, 
            {{ $tickets->where('status', 'solved')->count() ?? 0 }}, 
            {{ $tickets->where('status', 'closed')->count() ?? 0 }}
          ],
          backgroundColor: [
            '#F6AD55',
            '#4299E1',
            '#48BB78',
            '#A0AEC0'
          ],
          borderWidth: 0
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              color: textColor,
              padding: 20,
              font: {
                size: 12
              }
            }
          }
        },
        cutout: '70%'
      }
    });
    
    // Update charts when theme changes
    window.updateChartsTheme = function(isDark) {
      const newGridColor = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
      const newTextColor = isDark ? '#e2e8f0' : '#2c3e50';
      
      // Update tickets chart
      ticketsChart.options.scales.y.grid.color = newGridColor;
      ticketsChart.options.scales.x.grid.color = newGridColor;
      ticketsChart.options.scales.y.ticks.color = newTextColor;
      ticketsChart.options.scales.x.ticks.color = newTextColor;
      ticketsChart.options.plugins.legend.labels.color = newTextColor;
      ticketsChart.update();
      
      // Update status chart
      statusChart.options.plugins.legend.labels.color = newTextColor;
      statusChart.update();
    };
  });
</script>
@endpush
@endsection

