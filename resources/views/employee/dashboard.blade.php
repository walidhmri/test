@extends('layouts.app')
@section('content')

@push('styles')
<style>
    /* Dashboard Cards Layout */
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background-color: var(--bg-card);
        border-radius: 10px;
        box-shadow: 0 4px 20px var(--shadow-color);
        padding: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px var(--shadow-color);
    }
    
    .stat-card h3 {
        font-size: 16px;
        color: var(--text-muted);
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .stat-card .value {
        font-size: 28px;
        font-weight: bold;
        color: var(--text-color);
    }
    
    .stat-card .trend {
        font-size: 12px;
        margin-top: 5px;
    }
    
    .trend.up {
        color: #4caf50;
    }
    
    .trend.down {
        color: #f44336;
    }
    
    /* Charts Container */
    .charts-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }
    
    .chart-card {
        background-color: var(--bg-card);
        border-radius: 12px;
        box-shadow: 0 4px 20px var(--shadow-color);
        padding: 20px;
        transition: all 0.3s ease;
    }
    
    .chart-card:hover {
        box-shadow: 0 10px 30px var(--shadow-color);
    }
    
    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--border-color);
    }
    
    .chart-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-color);
        margin: 0;
    }
    
    .chart-subtitle {
        font-size: 14px;
        color: var(--text-muted);
        margin-top: 5px;
    }
    
    .chart-wrapper {
        position: relative;
        height: 300px;
        width: 100%;
    }
    
    canvas {
        max-width: 100%;
        height: auto !important;
        background-color: var(--bg-card);
    }
    
    /* Legend Styling */
    .chart-legend {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
        margin-top: 15px;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        font-size: 14px;
        color: var(--text-color);
    }
    
    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 3px;
        margin-right: 5px;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .charts-container {
            grid-template-columns: 1fr;
        }
        
        .chart-wrapper {
            height: 250px;
        }
    }
</style>
@endpush

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6 class="mb-1">Ticket Analytics Dashboard</h6>
                <p class="text-sm mb-0">
                    <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                    <span class="font-weight-bold">Updated</span> today
                </p>
            </div>
            <div class="card-body px-4 pt-0 pb-4">
                <!-- Stats Summary Cards -->
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <h3>Total Tickets</h3>
                        <div class="value">{{ $tickets->count() }}</div>
                        <div class="trend up">+12% from last month</div>
                    </div>
                    <div class="stat-card">
                        <h3>Pending</h3>
                        <div class="value">{{ $tickets->where('status', 'pending')->count() }}</div>
                        <div class="trend up">+5% from last month</div>
                    </div>
                    <div class="stat-card">
                        <h3>Solved</h3>
                        <div class="value">{{ $tickets->where('status', 'solved')->count() }}</div>
                        <div class="trend up">+8% from last month</div>
                    </div>
                    <div class="stat-card">
                        <h3>Closed</h3>
                        <div class="value">{{ $tickets->where('status', 'closed')->count() }}</div>
                        <div class="trend down">-3% from last month</div>
                    </div>
                </div>
                
                <!-- Charts Section -->
                <div class="charts-container">
                    <!-- Priority Chart -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <div>
                                <h3 class="chart-title">Ticket Priorities</h3>
                                <p class="chart-subtitle">Distribution by priority level</p>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="priorityChart"></canvas>
                        </div>
                        <div class="chart-legend" id="priority-legend"></div>
                    </div>
                    
                    <!-- Status Chart -->
                    <div class="chart-card">
                        <div class="chart-header">
                            <div>
                                <h3 class="chart-title">Ticket Status</h3>
                                <p class="chart-subtitle">Current status distribution</p>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="statusChart"></canvas>
                        </div>
                        <div class="chart-legend" id="status-legend"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if dark mode is active
        const isDarkMode = localStorage.getItem('dark') === 'true';
        
        // Set chart colors based on theme
        const chartTextColor = isDarkMode ? '#e9ecef' : '#344767';
        const chartGridColor = isDarkMode ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
        
        // Priority Chart Data
        let low = {{ $tickets->where('priority', 'low')->count() }};
        let medium = {{ $tickets->where('priority', 'medium')->count() }};
        let high = {{ $tickets->where('priority', 'high')->count() }};
        let urgent = {{ $tickets->where('priority', 'urgent')->count() }};
        
        // Ensure we have at least some data to display
        if (low == 0 && medium == 0 && high == 0 && urgent == 0) {
            low = 1;
            medium = 1;
            high = 1;
            urgent = 1;
        }
        
        // Status Chart Data
        let pending = {{ $tickets->where('status', 'pending')->count() }};
        let solved = {{ $tickets->where('status', 'solved')->count() }};
        let closed = {{ $tickets->where('status', 'closed')->count() }};
        
        // Ensure we have at least some data to display
        if (pending == 0 && solved == 0 && closed == 0) {
            pending = 1;
            solved = 1;
            closed = 1;
        }
        
        // Priority Chart Colors
        const priorityColors = [
            'rgba(75, 192, 192, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(255, 99, 132, 0.7)'
        ];
        
        const priorityBorderColors = [
            'rgba(75, 192, 192, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 99, 132, 1)'
        ];
        
        // Chart.js global defaults for dark mode
        Chart.defaults.color = chartTextColor;
        Chart.defaults.scale.grid.color = chartGridColor;
        
        // Priority Chart
        const priorityChart = new Chart(document.getElementById('priorityChart'), {
            type: 'bar',
            data: {
                labels: ['Low', 'Medium', 'High', 'Urgent'],
                datasets: [{
                    label: 'Number of Tickets',
                    data: [low, medium, high, urgent],
                    backgroundColor: priorityColors,
                    borderColor: priorityBorderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        
        // Create priority legend
        const priorityLegend = document.getElementById('priority-legend');
        const priorityLabels = ['Low', 'Medium', 'High', 'Urgent'];
        
        priorityLegend.innerHTML = '';
        priorityLabels.forEach((label, index) => {
            const legendItem = document.createElement('div');
            legendItem.className = 'legend-item';
            
            const colorBox = document.createElement('span');
            colorBox.className = 'legend-color';
            colorBox.style.backgroundColor = priorityColors[index];
            
            const labelText = document.createElement('span');
            labelText.textContent = label;
            
            legendItem.appendChild(colorBox);
            legendItem.appendChild(labelText);
            priorityLegend.appendChild(legendItem);
        });
        
        // Status Chart Colors
        const statusColors = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 205, 86, 0.7)'
        ];
        
        const statusBorderColors = [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 205, 86, 1)'
        ];
        
        // Status Chart
        const statusChart = new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Solved', 'Closed'],
                datasets: [{
                    data: [pending, solved, closed],
                    backgroundColor: statusColors,
                    borderColor: statusBorderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw;
                                const total = context.dataset.data.reduce((acc, data) => acc + data, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });
        
        // Create status legend
        const statusLegend = document.getElementById('status-legend');
        const statusLabels = ['Pending', 'Solved', 'Closed'];
        
        statusLegend.innerHTML = '';
        statusLabels.forEach((label, index) => {
            const legendItem = document.createElement('div');
            legendItem.className = 'legend-item';
            
            const colorBox = document.createElement('span');
            colorBox.className = 'legend-color';
            colorBox.style.backgroundColor = statusColors[index];
            
            const labelText = document.createElement('span');
            labelText.textContent = label;
            
            legendItem.appendChild(colorBox);
            legendItem.appendChild(labelText);
            statusLegend.appendChild(legendItem);
        });
        
        // Function to update charts when theme changes
        window.updateChartsTheme = function(isDark) {
            const newTextColor = isDark ? '#e9ecef' : '#344767';
            const newGridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
            
            // Update Chart.js defaults
            Chart.defaults.color = newTextColor;
            Chart.defaults.scale.grid.color = newGridColor;
            
            // Update and redraw charts
            priorityChart.options.scales.y.grid.color = newGridColor;
            priorityChart.options.scales.x.ticks.color = newTextColor;
            priorityChart.update();
            
            statusChart.options.plugins.tooltip.bodyColor = newTextColor;
            statusChart.update();
        };
    });
</script>
@endpush
@endsection