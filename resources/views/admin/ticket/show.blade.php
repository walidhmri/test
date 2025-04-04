@extends('layouts.admin')

@section('title', 'Ticket Details - #' . $ticket->id)

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Session Messages --}}
    @include('admin.partials.session')

    {{-- Main Ticket Card --}}
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden mb-6">
        {{-- Card Header --}}
        <div class="px-6 py-5 flex flex-col sm:flex-row justify-between sm:items-center border-b border-gray-200 dark:border-gray-700">
            {{-- Left Side: Title & Submitter --}}
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-1 sm:mb-0">
                    Ticket #{{ $ticket->id }}
                </h2>
                {{-- Check if $employee is passed and not null --}}
                @if(isset($employee))
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Submitted by:
                        <a href="{{ route('admin.profile.show', ['id' => $employee->id]) }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">
                            {{ $employee->name }}
                        </a>
                    </p>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">Submitter information unavailable.</p>
                @endif
            </div>

            {{-- Right Side: Header Actions --}}
            <div class="flex items-center space-x-2 mt-4 sm:mt-0 flex-shrink-0">
                {{-- Download PDF Button --}}
                <a href="{{ route('pdf.ticket', ['id' => $ticket->id]) }}"
                   title="Download Ticket as PDF"
                   class="inline-flex items-center justify-center px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2 hidden sm:inline">PDF</span>
                </a>

                {{-- Add Solution Button --}}
                <a href="{{ route('admin.tickets.solve', ['id' => $ticket->id,'user_id'=>$ticket->user_id]) }}"
                    title="Add Solution"
                    class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-700 dark:hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-900 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m-8-8h16"/>
                    </svg>
                    <span class="ml-2">Add Solution</span> 
                </a>
            </div>
        </div>

        {{-- Form for Updates --}}
        <form method="POST" action="{{ route('admin.tickets.update', ['id' => $ticket->id]) }}" id="ticketUpdateForm">
            @csrf
            @method('PATCH')

            {{-- Ticket Details List --}}
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                {{-- Title Row --}}
                <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Title</dt>
                    <dd class="text-sm text-gray-900 dark:text-white md:col-span-2">
                        {{ $ticket->title ?? 'N/A' }}
                    </dd>
                </div>

                {{-- Description Row --}}
                <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</dt>
                    <dd class="text-sm text-gray-900 dark:text-white md:col-span-2 whitespace-pre-wrap">
                        {{ $ticket->description ?? 'No description provided.' }}
                    </dd>
                </div>

                <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2 items-center">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        <label for="status">@lang('messages.Assign')</label>
                    </dt>
                    <dd class="md:col-span-2">
                        <select id="status" name="assign" 
                        class="block w-full max-w-xs rounded-md border-gray-300 dark:border-gray-600 py-2 px-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200 sm:text-sm">
                    
                        <option value="" @if(old('assign', $ingenieur->assign ?? '') == '') selected @endif>Unassigned</option>
                    
                        @foreach ($ingenieurs as $ingenieur)
                            <option value="{{ $ingenieur->id }}" @selected(old('assign', $ticket->assign) == $ingenieur->id)>{{ $ingenieur->name }}</option>
                        @endforeach
                    
                    </select>
                    </dd>
                </div>


                {{-- Status Row (Editable) --}}
                <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2 items-center">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        <label for="status">@lang('messages.status')</label>
                    </dt>
                    <dd class="md:col-span-2">
                        <select id="status" name="status"
                                class="block w-full max-w-xs rounded-md border-gray-300 dark:border-gray-600 py-2 px-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200 sm:text-sm">
                            <option value="pending" @selected(old('status', $ticket->status) == 'pending')>Pending</option>
                            <option value="solved" @selected(old('status', $ticket->status) == 'solved')>Solved</option>
                            <option value="closed" @selected(old('status', $ticket->status) == 'closed')>Closed</option>
                        </select>
                    </dd>
                </div>

                {{-- Priority Row (Editable) --}}
                <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2 items-center">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        <label for="priority">Priority</label>
                    </dt>
                    <dd class="md:col-span-2">
                         <select id="priority" name="priority"
                                class="block w-full max-w-xs rounded-md border-gray-300 dark:border-gray-600 py-2 px-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200 sm:text-sm">
                            <option value="low" @selected(old('priority', $ticket->priority) == 'low')>Low</option>
                            <option value="medium" @selected(old('priority', $ticket->priority) == 'medium')>Medium</option>
                            <option value="high" @selected(old('priority', $ticket->priority) == 'high')>High</option>
                            <option value="urgent" @selected(old('priority', $ticket->priority) == 'urgent') class="font-semibold text-red-600 dark:text-red-400">
                                Urgent
                            </option>
                        </select>
                    </dd>
                </div>

                {{-- Created At Row --}}
                <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</dt>
                    <dd class="text-sm text-gray-900 dark:text-white md:col-span-2">
                        @if($ticket->created_at)
                            {{ $ticket->created_at->format('F j, Y - H:i') }}
                            <span class="text-xs text-gray-500 dark:text-gray-400">({{ $ticket->created_at->diffForHumans() }})</span>
                        @else
                            N/A
                        @endif
                    </dd>
                </div>

                {{-- Attachment Row --}}
                <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Attachment</dt>
                    <dd class="text-sm text-gray-900 dark:text-white md:col-span-2">
                        @if (!empty($ticket->file))
                            <div class="flex items-start space-x-3">
                                {{-- Generic Icon --}}
                                <div class="flex-shrink-0 w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded border border-gray-300 dark:border-gray-600 flex items-center justify-center text-gray-400 dark:text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 9H9" />
                                    </svg>
                                </div>
                                {{-- File Info & Download --}}
                                <div class="flex-grow">
                                    <p class="font-medium text-gray-800 dark:text-gray-100 break-all">
                                        {{ basename($ticket->file) }}
                                    </p>
                                
                                    <div class="flex mt-1 space-x-3">
                                        {{-- Download Button --}}
                                        <a href="{{ asset('storage/' . $ticket->file) }}" download="{{ basename($ticket->file) }}"
                                           class="inline-flex items-center text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Download
                                        </a>
                                    
                                        {{-- View Button --}}
                                        <a href="{{ asset('storage/' . $ticket->file) }}" target="_blank"
                                           class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-gray-500 dark:text-gray-400 italic">No file attached</span>
                        @endif
                    </dd>
                </div>
            </div> {{-- End Details List --}}

            {{-- Form Actions / Footer --}}
            <div class=" text-gray-300 px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-300 dark:border-gray-700 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center text-gray-300 gap-2 justify-center py-2 px-4 border shadow-sm text-sm font-medium rounded-lg  dark:text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 text-white dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Ticket Details
                </button>
            </div>
        </form> {{-- End Form --}}
    </div> {{-- End Card --}}

    {{-- Solutions Section (Reddit-style) --}}
    <div class="mt-8">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
            </svg>
            Solutions ({{ isset($solutions) && is_countable($solutions) ? count($solutions) : 0 }})
        </h3>

        @if(isset($solutions) && is_countable($solutions) && count($solutions) > 0)
            <div class="space-y-4" id="solutions-container">
                @foreach($solutions as $solution)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 solution-item" id="solution-{{ $solution->id }}">
                        <!-- Solution Header -->
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 flex items-center justify-between border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center space-x-3">
                                <!-- Engineer Avatar -->
                                <div class="h-10 w-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-500 dark:text-indigo-400 overflow-hidden">
                                    @if(isset($solution->user) && $solution->user->profile_photo_path)
                                        <img src="{{ asset('storage/'.$solution->user->profile_photo_path) }}" alt="{{ $solution->user->name }}" class="h-full w-full object-cover">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    @endif
                                </div>
                                
                                <!-- Engineer Info -->
                                <div>
                                    <h4 class="font-medium text-gray-900 dark:text-white">
                                        {{ isset($solution->user) ? $solution->user->name : 'Unknown Engineer' }}
                                    </h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $solution->created_at->format('M j, Y • g:i A') }} 
                                        @if($solution->created_at != $solution->updated_at)
                                            <span class="italic">(edited)</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <a href="" 
                                   class="text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button type="button" 
                                        class="delete-solution-btn text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 p-1 rounded-full hover:bg-gray-100 dark:hover:bg-gray-600"
                                        data-solution-id="{{ $solution->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Solution Content -->
                        <div class="px-4 py-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200">
                            <!-- Solution Title -->
                            @if(isset($solution->title) && !empty($solution->title))
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $solution->title }}</h3>
                            @endif
                            
                            <!-- Solution Description -->
                            @if(isset($solution->description) && !empty($solution->description))
                                <div class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                                    {{ $solution->description }}
                                </div>
                            @endif
                            
                            <!-- Solution File (if available) -->
                            @if(isset($solution->file) && !empty($solution->file))
                                <div class="mt-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-md">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 w-8 h-8 bg-indigo-100 dark:bg-indigo-900 rounded border border-indigo-200 dark:border-indigo-800 flex items-center justify-center text-indigo-500 dark:text-indigo-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                                {{ basename($solution->file) }}
                                            </p>
                                            <div class="flex mt-1 space-x-3">
                                                <a href="{{ asset('storage/' . $solution->file) }}" download class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">
                                                    Download
                                                </a>
                                                <a href="{{ asset('storage/' . $solution->file) }}" target="_blank" class="text-xs text-gray-600 dark:text-gray-400 hover:underline">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Solution Footer -->
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-2 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <!-- Upvote/Downvote (Optional) -->
                                <div class="flex items-center space-x-2 mr-4">
                                    <button type="button" class="upvote-btn flex items-center hover:text-indigo-600 dark:hover:text-indigo-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg>
                                        <span class="ml-1">{{ rand(0, 15) }}</span>
                                    </button>
                                </div>
                                
                                <!-- Solution Tags -->
                                @if(isset($solution->tags) && !empty($solution->tags))
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(explode(',', $solution->tags) as $tag)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                                                {{ trim($tag) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center border border-gray-200 dark:border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No solutions yet</h4>
                <p class="text-gray-500 dark:text-gray-400 mb-4">Be the first to provide a solution for this ticket.</p>
                <a href="{{ route('admin.tickets.solve', ['id' => $ticket->id, 'user_id' => $ticket->user_id]) }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-700 dark:hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add Solution
                </a>
            </div>
        @endif
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-sm w-full mx-4 overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Confirm Deletion</h3>
            </div>
            <div class="px-4 py-3">
                <p class="text-gray-700 dark:text-gray-300">Are you sure you want to delete this solution?</p>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">This action cannot be undone.</p>
            </div>
            <form id="deleteSolutionForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 flex justify-end space-x-2">
                    <button type="button" id="cancelDelete" class="px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-900">
                        Cancel
                    </button>
                    <button type="submit" class="px-3 py-1.5 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-900">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get DOM elements
    const deleteModal = document.getElementById('deleteModal');
    const cancelDelete = document.getElementById('cancelDelete');
    const deleteSolutionForm = document.getElementById('deleteSolutionForm');
    
    // Delete Solution
    const deleteButtons = document.querySelectorAll('.delete-solution-btn');
    if (deleteButtons.length > 0) {
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const solutionId = this.getAttribute('data-solution-id');
                // Set the form action URL
                deleteSolutionForm.action = `/admin/solutions/${solutionId}/delete`;
                // Show the modal
                deleteModal.classList.remove('hidden');
            });
        });
    }
    
    // Cancel Delete
    if (cancelDelete) {
        cancelDelete.addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });
    }
    
    // Close modal when clicking outside
    if (deleteModal) {
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                deleteModal.classList.add('hidden');
            }
        });
    }
    
    // Upvote functionality (for demonstration)
    const upvoteButtons = document.querySelectorAll('.upvote-btn');
    if (upvoteButtons.length > 0) {
        upvoteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const countSpan = this.querySelector('span');
                let count = parseInt(countSpan.textContent);
                countSpan.textContent = count + 1;
                
                // Toggle active state
                this.classList.toggle('text-indigo-600');
                this.classList.toggle('dark:text-indigo-400');
            });
        });
    }
    
    // Check for dark mode
    function updateTheme() {
        const isDarkMode = localStorage.getItem('dark') === 'true';
        if (isDarkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
    
    // Initial theme check
    updateTheme();
    
    // Listen for theme changes
    window.addEventListener('storage', function(e) {
        if (e.key === 'dark') {
            updateTheme();
        }
    });
});
</script>
@endsection