@extends('layouts.admin')
@section('title')
Admin Dashboard
@endsection
@section('content')
<meta name="tickets-low" content="{{ $tickets->where('priority' ,'low')->count() }}">
<meta name="tickets-medium" content="{{ $tickets->where('priority' ,'medium')->count() }}">
<meta name="tickets-high" content="{{ $tickets->where('priority' ,'high')->count() }}">
<meta name="tickets-urgent" content="{{ $tickets->where('priority' ,'urgent')->count() }}">
@for ($i = 1; $i <= 7; $i++)
    @php
        $solvedTickets = $tickets->filter(function ($ticket) use ($i) {
            return \Carbon\Carbon::parse($ticket->updated_at)->month == $i &&
                   \Carbon\Carbon::parse($ticket->updated_at)->year == now()->year &&
                   $ticket->status == 'solved';
        })->count();
    @endphp

    <meta name="tickets-solved-{{ $i }}" content="{{ $solvedTickets }}">
@endfor
@for ($i = 1; $i <= 7; $i++)
    @php
        $pendingTickets = $tickets->filter(function ($ticket) use ($i) {
            return \Carbon\Carbon::parse($ticket->updated_at)->month == $i &&
                   \Carbon\Carbon::parse($ticket->updated_at)->year == now()->year &&
                   $ticket->status == 'pending';
        })->count();
    @endphp

    <meta name="tickets-pending-{{ $i }}" content="{{ $pendingTickets }}">
@endfor

                  
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">Dashboard</h2>

    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total Employees
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $employees->where('role' ,'user')->count() }}
                </p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2a4 4 0 100 8 4 4 0 000-8zM2 18a8 8 0 1116 0H2z"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total Ingenieurs
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ $employees->where('role' ,'ingenieur')->count() }}
                </p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4 4a2 2 0 00-2 2v2.5a1.5 1.5 0 110 3V14a2 2 0 002 2h12a2 2 0 002-2v-2.5a1.5 1.5 0 110-3V6a2 2 0 00-2-2H4zm10 6a1 1 0 100-2 1 1 0 000 2zm-4 0a1 1 0 100-2 1 1 0 000 2zm-4 0a1 1 0 100-2 1 1 0 000 2z"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total Tickets
                </p>
                <p id="tickets" class="text-lg font-semibold text-gray-700 dark:text-gray-200" value="{{$tickets->count()}}">
                    {{$tickets->count()}}
                </p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2a4 4 0 100 8 4 4 0 000-8zM2 18a8 8 0 1116 0H2z"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Tickets solved
                </p>
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{$tickets->where('status' ,'solved')->count()}}
                </p>
            </div>
        </div>
    </div>

    <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Priority
              </h4>
              <canvas id="pie"></canvas>
              

            </div>
            <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
              <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Traffic
              </h4>
              <canvas id="line"></canvas>
              <div class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400">
                <!-- Chart legend -->
                <div class="flex items-center">
                  <span class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"></span>
                  <span>Organic</span>
                </div>
                <div class="flex items-center">
                  <span class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"></span>
                  <span>Paid</span>
                </div>
              </div>
            </div>
          </div>

</div>
@endsection