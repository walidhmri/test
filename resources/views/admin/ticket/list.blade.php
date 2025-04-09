@extends('layouts.admin')
@section('title', 'Tickets List')
@section('content')
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <!-- Alerts -->
        @if (session('error'))
            <div class="bg-white dark:bg-gray-800 border-l-4 border-red-500 rounded-lg shadow-lg p-4 mb-6 flex items-center" role="alert">
                <div class="bg-red-100 dark:bg-red-900/30 p-2 rounded-full mr-3">
                    <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-800 dark:text-gray-200">خطأ!</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ session('error') }}</p>
                </div>
            </div>
        @endif
        
        @if (session('success'))
            <div class="bg-white dark:bg-gray-800 border-l-4 border-green-500 rounded-lg shadow-lg p-4 mb-6 flex items-center" role="alert">
                <div class="bg-green-100 dark:bg-green-900/30 p-2 rounded-full mr-3">
                    <svg class="w-6 h-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-800 dark:text-gray-200">نجاح!</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Header Section -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 sm:p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="mb-4 sm:mb-0">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100">Tickets</h2>
                    <p class="text-gray-500 dark:text-gray-400 mt-1">Manage and track support requests</p>
                </div>
                
                <button id="toggleFilters" class="bg-gradient-to-r text-gray-800 dark:text-gray-100 from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-medium px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    <span class="hidden sm:inline">Filter Tickets</span>
                    <span class="sm:hidden">Filter</span>
                </button>
            </div>
        </div>
        
        <!-- Filters Panel -->
        <div id="filterSection" class="bg-white dark:bg-gray-800 rounded-xl shadow-lg mb-8 overflow-hidden transition-all duration-300 transform">
            <div class="border-b border-gray-200 dark:border-gray-700">
                <div class="p-4 sm:p-5">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Advanced Filters</h3>
                </div>
            </div>
            
            <form method="get" action="{{ route('admin.tickets.list') }}" class="p-4 sm:p-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Priority</label>
                        <div class="relative">
                            <select name="priority" class="appearance-none block w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg py-2.5 px-4 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="" {{ request('priority') == '' ? 'selected' : '' }}>All Priorities</option>
                                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                                <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                        <div class="relative">
                            <select name="status" class="appearance-none block w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg py-2.5 px-4 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="" {{ request('status') == '' ? 'selected' : '' }}>All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="solved" {{ request('status') == 'solved' ? 'selected' : '' }}>Solved</option>
                                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Assignment</label>
                        <div class="relative">
                            <select name="assign" class="appearance-none block w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg py-2.5 px-4 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="" {{ request('assign') == '' ? 'selected' : '' }}>All Assignments</option>
                                <option value="true" {{ request('assign') == 'true' ? 'selected' : '' }}>Assigned</option>
                                <option value="false" {{ request('assign') == 'false' ? 'selected' : '' }}>Not Assigned</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Employee</label>
                        <div class="relative">
                            <select name="employee_id" class="appearance-none block w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg py-2.5 px-4 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="" {{ request('employee_id') == '' ? 'selected' : '' }}>All Employees</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Month</label>
                        <input type="month" name="month" id="month" value="{{ request('month') }}" class="appearance-none block w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg py-2.5 px-4 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Order By</label>
                        <div class="relative">
                            <select name="order" class="appearance-none block w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg py-2.5 px-4 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Last created</option>
                                <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>First Created</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="text-gray-800 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-medium px-4 py-2 sm:px-6 sm:py-2.5 rounded-lg dark:text-gray-100 shadow-md hover:shadow-lg transition-all duration-200 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Tickets Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6">
            @foreach ($tickets as $ticket)
                <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
                    <!-- Ticket Header with Status Background -->
                    <div class="p-4 sm:p-5 relative
                        @switch($ticket->status)
                            @case('pending') bg-amber-50 dark:bg-amber-900/20 @break
                            @case('solved') bg-green-50 dark:bg-green-900/20 @break
                            @case('closed') bg-blue-50 dark:bg-blue-900/20 @break
                            @default bg-gray-50 dark:bg-gray-700/50
                        @endswitch
                        border-b border-gray-100 dark:border-gray-700">
                        
                        <!-- Priority and Status Indicators - Fixed spacing and visibility -->
                        <div class="absolute top-0 right-0 mt-4 sm:mt-5 mr-4 sm:mr-5">
                            <div class="flex flex-col space-y-2">
                                <span class="inline-block text-xs font-medium px-2.5 py-1 rounded-full
                                    @switch($ticket->priority)
                                        @case('low') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 @break
                                        @case('medium') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100 @break
                                        @case('high') bg-orange-100 text-dark-800 dark:bg-orange-800 dark:text-dark-100 @break
                                        @case('urgent') bg-red-100 text-dark-800 dark:bg-red-800 dark:text-dark-100 @break
                                        @default bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100
                                    @endswitch">
                                    {{ ucfirst($ticket->priority) }}
                                </span>
                                <span class="inline-block text-xs font-medium px-2.5 py-1 rounded-full
                                    @switch($ticket->status)
                                        @case('pending') bg-amber-100 text-amber-800 dark:bg-amber-800 dark:text-amber-100 @break
                                        @case('solved') bg-green-100 text-dark-800 dark:bg-green-800 dark:text-dark-100 @break
                                        @case('closed') bg-blue-100 text-dark-800 dark:bg-blue-800 dark:text-dark-100 @break
                                        @default bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100
                                    @endswitch">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Ticket ID -->
                        <div class="inline-flex items-center justify-center px-2.5 py-1 bg-gray-100 dark:bg-gray-700 rounded-lg text-xs font-medium text-gray-800 dark:text-gray-200 mb-3">
                            ID: {{ $ticket->id }}
                        </div>
                        
                        <!-- Ticket Title -->
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-white mb-2 pr-20">
                            {{ \Illuminate\Support\Str::words($ticket->title, 5, '...') }}
                        </h3>
                        
                        <!-- Ticket Role (if available) -->
                        @if(isset($ticket->role))
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $ticket->role }}
                        </p>
                        @endif
                    </div>
                    
                    <!-- Ticket Details -->
                    <div class="p-4 sm:p-5 flex-grow">
                        <div class="space-y-3 sm:space-y-4">
                            <!-- Employee -->
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 sm:h-9 sm:w-9 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center">
                                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">Employee</p>
                                    <a href="{{route('admin.profile.show', ['id'=>$ticket->user_id])}}" class="text-xs sm:text-sm font-semibold text-purple-600 hover:text-purple-800 dark:text-purple-400 dark:hover:text-purple-300">
                                        {{ $employees->where('id', $ticket->user_id)->first()->name }}
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Date -->
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 sm:h-9 sm:w-9 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">Created</p>
                                    <p class="text-xs sm:text-sm font-semibold text-gray-800 dark:text-gray-200">
                                        {{ $ticket->created_at->format('Y-m-d') }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Assignment -->
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 sm:h-9 sm:w-9 bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center">
                                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">Assignment</p>
                                    <p class="text-xs sm:text-sm font-semibold text-gray-800 dark:text-gray-200">
                                        @php
                                            if($ticket->assign != null){
                                                echo 'Assigned';
                                            } 
                                            else{
                                                echo 'Not Assigned';
                                            }
                                        @endphp
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Ticket Actions - Fixed dark mode background -->
                    <div class="p-4 sm:p-5 bg-gray-50 dark:bg-gray-700 border-t border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-center gap-3">
                        <a href="{{ route('admin.tickets.show', ['id' => $ticket->id, 'user_id' => $ticket->user_id]) }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-lg text-sm font-medium text-gray-800  hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2 text-gray-500 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Details
                        </a>
                        
                        <form method="post" action="{{ route('admin.tickets.delete', $ticket->id) }}" class="w-full sm:w-auto">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Vous voulez supprimer {{ $ticket->title }}?')" 
                                class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-lg text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Empty State -->
        @if (count($tickets) == 0)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sm:p-8 text-center">
                <div class="inline-flex items-center justify-center p-3 sm:p-4 bg-gray-100 dark:bg-gray-700 rounded-full mb-4">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">No Tickets Found</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">There are no tickets matching your criteria.</p>
                <a href="{{ route('admin.tickets.list') }}" class="inline-flex items-center px-4 py-2 sm:px-5 sm:py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Reset Filters
                </a>
            </div>
        @endif
        
        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $tickets->appends(request()->query())->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleFiltersBtn = document.getElementById('toggleFilters');
            const filterSection = document.getElementById('filterSection');
            
            // Check if filters are applied
            const urlParams = new URLSearchParams(window.location.search);
            const hasFilters = urlParams.toString() !== '';
            
            // Initially hide filter section if no filters are applied
            if (!hasFilters) {
                filterSection.style.display = 'none';
            }
            
            toggleFiltersBtn.addEventListener('click', function() {
                if (filterSection.style.display === 'none') {
                    filterSection.style.display = 'block';
                    filterSection.classList.add('scale-100');
                    filterSection.classList.remove('scale-95');
                } else {
                    filterSection.style.display = 'none';
                    filterSection.classList.add('scale-95');
                    filterSection.classList.remove('scale-100');
                }
            });
        });
    </script>
@endsection