@extends('layouts.app')
@section('content')

@push('styles')
<style>
    /* جعل الرسوم البيانية مرتبة بشكل أفقي */
    .my_chart {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        padding: 20px;
    }

    /* تخصيص تصميم الرسم البياني */
    canvas {
        max-width: 400px;
        max-height: 400px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 10px;
    }

    /* تخصيص تصميم القسم الثاني */
    .second-label {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        color: #444;
        background: #f9f9f9;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

<div class="my_chart">
    <canvas name="chart1" id="myChart"></canvas>
   <div class="second-label">
    <p>Second label {{ $tickets->where('priority' ,'low')->count() }}</p>
    <canvas name="chart2" id="MySecondChart">
    </canvas>
   </div>
  
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>
let low = {{$tickets->where('priority' ,'low')->count()}};
let medium =  {{$tickets->where('priority' ,'medium')->count()}};
let high ={{ $tickets->where('priority' ,'high')->count()}};
let urgent ={{ $tickets->where('priority' ,'urgent')->count()}};
if(low == 0 && medium == 0 && high == 0 && urgent == 0){
  low = 1;
  medium = 1; 
  high = 1;
  urgent = 1;
}
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Low', 'Medium', 'High', 'Urgent'],
        datasets: [{
          label: '# of Votes',
          data: [low,medium, high, urgent],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });




  </script>
  <script>
    let pending = {{$tickets->where('status','pending')->count()}};;
    let solved = {{$tickets->where('status','solved')->count()}};
    let closed = {{$tickets->where('status','closed')->count()}};
    if(pending == 0 && solved == 0 && closed == 0){
      pending = 1;
      solved = 1; 
      closed = 1;
    }
   
    const data = {
        labels: ['pending', 'solved', 'closed'],
        datasets: [{
            label: 'Status',
            data: [pending, solved, closed],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart(document.getElementById('MySecondChart'), {
        type: 'doughnut',
        data: data,
        options: {
        plugins: {
            legend: {
                display: false 
            }
        }
    }
    });
    document.getElementById('legend-container').innerHTML = myChart.generateLegend();

  </script>
   


@endsection 
