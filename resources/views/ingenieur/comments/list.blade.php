@extends('layouts.ingenieur')
@section('title', 'Comments List')
@section('content')
<div class="w-full px-4 sm:px-6 lg:px-8">
    <!-- Alerts Section (kept for functionality) -->
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
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 dark:text-gray-100">Comments</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Manage and track responses</p>
            </div>
        </div>
    </div>
    
    <!-- Comments List - Redesigned as individual cards with better spacing -->
    <div class="space-y-4">
 
        @foreach ($comments as $comment)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden mb-4">
        <!-- Comment Header with Ticket Badge -->
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 dark:border-gray-700">
            <div class="flex items-center space-x-3">
                <!-- Avatar Circle -->
                <div class="h-10 w-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                
                <!-- User Info -->
                <div>
                    <a href="{{route('admin.profile.show', ['id'=>$comment->user_id])}}" class="text-sm font-semibold text-gray-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400">
                        {{ $comment->user->name ?? 'Employee' }}
                    </a>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ $comment->created_at->format('M d, Y • h:i A') }}
                    </p>
                </div>
            </div>
            
            <!-- Ticket Badge -->
            <div class="px-3 py-1.5 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-full">
                Ticket #{{ $comment->Ticket_id }}
            </div>
        </div>
        
        <!-- Comment Content -->
        <div class="p-5">
            <p class="text-gray-700 dark:text-gray-300 text-base">
                {{ \Illuminate\Support\Str::words($comment->content, 20, '...') }}
            </p>
        </div>
        
        <!-- Comment Footer with Timestamp and Actions -->
        <div class="px-5 py-3 bg-gray-50 dark:bg-gray-750 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center">
            <!-- Timestamp -->
            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                <svg class="w-4 h-4 mr-1.5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $comment->created_at->diffForHumans() }}
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-2">
                <!-- View Ticket Button -->
                <a href="{{ route('ingenieur.Ticket.show', ['id' => $comment->Ticket_id]) }}" 
                   class="inline-flex items-center justify-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md shadow-sm hover:shadow transition-all duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                    View Ticket
                </a>
                
                <!-- View Details Button -->
                <a href="{{ route('ingenieur.Ticket.show', ['id' => $comment->Ticket_id, 'user_id' => $comment->user_id]) }}"
                   class="inline-flex items-center justify-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-md shadow-sm hover:shadow transition-all duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View Details
                </a>
            </div>
        </div>
    </div>
@endforeach
        <!-- If no foreach loop is available, show a static example -->
        @if(empty($comments) || count($comments) == 0)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                <!-- Comment Header with Ticket Badge -->
                <div class="flex items-center justify-between px-5 py-4 bg-gray-50 dark:bg-gray-750 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center space-x-3">
                        <!-- Avatar Circle -->
                        <div class="h-10 w-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        
                        <!-- User Info -->
                        <div>
                            <a href="#" class="text-sm font-semibold text-gray-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400">
                                Employee Test
                            </a>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Apr 21, 2025 • 06:45 AM
                            </p>
                        </div>
                    </div>
                    
                    <!-- Ticket Badge -->
                    <div class="px-3 py-1.5 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-full">
                        Ticket #40
                    </div>
                </div>
                
                <!-- Comment Content -->
                <div class="p-5">
                    <p class="text-gray-700 dark:text-gray-300 text-base">
                        merci a vous
                    </p>
                </div>
                
                <!-- Comment Footer with Timestamp and Actions -->
                <div class="px-5 py-3 bg-gray-50 dark:bg-gray-750 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center">
                    <!-- Timestamp -->
                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4 mr-1.5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        il y a 10 minutes
                    </div>
                    
                    <!-- View Details Button -->
                    <a href="#" class="inline-flex items-center justify-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow-sm hover:shadow transition-all duration-200">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View Details
                    </a>
                </div>
            </div>
        @endif
    </div>
    
    <!-- Empty State (kept for functionality) -->
    @if (isset($comments) && count($comments) == 0)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sm:p-8 text-center mt-6">
            <div class="inline-flex items-center justify-center p-3 sm:p-4 bg-gray-100 dark:bg-gray-700 rounded-full mb-4">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
            </div>
            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">No Comments Found</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">There are no comments to display at the moment.</p>
            <a href="{{ route('admin.comments.list') }}" class="inline-flex items-center px-4 py-2 sm:px-5 sm:py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Refresh List
            </a>
        </div>
    @endif
</div>
@endsection