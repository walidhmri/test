@extends('layouts.admin')
@section('title', 'Show Profile')
@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Profile Information            
                 <button type="submit" onclick="window.location='{{ route('admin.employee.editemployee', ['id' => $employee->id]) }}'"
                class=" items-center  px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                aria-label="Edit">
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                    </path>
                </svg>
            </button> </h2>

        </div>
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        
        @endif
        <div class="border-t border-gray-200 dark:border-gray-700">
            <dl>
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Full name</dt>
                    <dd class="mt-1 text-sm text-gray-800  dark:text-white sm:mt-0 sm:col-span-2">
                        {{ $employee->name }}
                    </dd>
                </div>
                <div class="bg-white dark:bg-gray-800 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Email address</dt>
                    <dd class="mt-1 text-sm text-gray-800  dark:text-white sm:mt-0 sm:col-span-2">
                        {{ $employee->email }}
                    </dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Role</dt>
                    <dd class="mt-1 text-sm text-gray-800  dark:text-white sm:mt-0 sm:col-span-2">
                        {{ $employee->role }}
                    </dd>
                </div>
                <div class="bg-white dark:bg-gray-800 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Created At</dt>
                    <dd class="mt-1 text-sm text-gray-800  dark:text-white sm:mt-0 sm:col-span-2">
                        {{ $employee->created_at }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Employee Tickets</h2>

    @if($employee->role == 'user')
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
                                    @case('low') bg-green-100 text-white-800 dark:bg-green-800 dark:text-white-100 @break
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
        <div class="mt-8 flex justify-center">
            {{ $tickets->appends(request()->query())->links() }}
        </div>
    </div>
    @elseif($employee->role == 'ingenieur' or $employee->role == 'admin')
    @include('admin.partials.display_solutions',['solutions'=>$solutions])
    @endif

</div>
@endsection