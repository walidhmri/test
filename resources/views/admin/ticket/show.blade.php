@extends('layouts.admin')

@section('title', 'Ticket Details - #' . $ticket->id)

@section('content')

    {{-- Session Messages --}}
    @include('admin.partials.session')

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Main Ticket Card --}}
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">

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
                        <span class="ml-2 hidden sm:inline">PDF</span> {{-- Hide text on very small screens --}}
                    </a>

                    {{-- Solve Button --}}
                    <a href="{{ route('admin.tickets.solve', ['id' => $ticket->id,'user_id'=>$ticket->user_id]) }}"
                        title="Add Solution"
                        class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-transparent rounded-lg shadow-sm text-sm font-medium text-gray-900 bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:text-white dark:focus:ring-offset-gray-900 transition ease-in-out duration-150">
                        
                        <!-- أيقونة الإضافة (Add Solution) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current text-gray-900 dark:text-white" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m-8-8h16"/>
                        </svg>
                     
                        <span class="ml-2">Add Solution</span> 
                     </a>
                     
                     
                </div>
            </div>

            {{-- Form for Updates --}}
            <form method="POST" action="{{ route('admin.tickets.update', ['id' => $ticket->id]) }}">
                @csrf
                @method('PATCH') {{-- Or PUT --}}

                {{-- Ticket Details List --}}
                <div class="divide-y divide-gray-200 dark:divide-gray-700">

                    {{-- Title Row --}}
                    <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Title</dt>
                        <dd class="text-sm text-gray-900 dark:text-white md:col-span-2">
                            {{ $ticket->title ?? 'N/A' }} {{-- Add null coalescing for safety --}}
                        </dd>
                    </div>

                    {{-- Description Row --}}
                    <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</dt>
                        <dd class="text-sm text-gray-900 dark:text-white md:col-span-2 whitespace-pre-wrap">
                            {{ $ticket->description ?? 'No description provided.' }}
                        </dd>
                    </div>

                    {{-- Status Row (Editable) --}}
                    <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-2 items-center">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            <label for="status">@lang('messages.status')</label>
                        </dt>
                        <dd class="md:col-span-2">
                            {{-- Check if @tailwindcss/forms is installed for optimal styling --}}
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
                                {{ $ticket->created_at->format('F j, Y - H:i') }} {{-- Slightly shorter format --}}
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
                            {{-- Check if 'file' property exists and is not null/empty --}}
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
                                    
                                        {{-- حجم الملف --}}
                                    
                                    
                                        {{-- زر التحميل --}}
                                        <a href="{{ asset('storage/' . $ticket->file) }}" download="{{ basename($ticket->file) }}"
                                           class="mt-1 inline-flex items-center text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Download
                                        </a>
                                    
                                        {{-- رابط المشاهدة --}}
                                        <a href="{{ asset('storage/' . $ticket->file) }}" target="_blank"
                                           class="mt-1 ml-3 inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            View
                                        </a>
                                    </div>
                                    
                            @else
                                <span class="text-gray-500 dark:text-gray-400 italic">No file attached</span>
                            @endif
                        </dd>
                    </div>

                </div> {{-- End Details List --}}

                {{-- Form Actions / Footer --}}
                <div class="px-6 py-4 bg-white dark:bg-gray-800 border-t border-gray-300 dark:border-gray-700 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 justify-center py-2 px-4 border border-gray-300 dark:border-transparent shadow-sm text-sm font-medium rounded-lg text-gray-900 bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:text-white dark:focus:ring-offset-gray-900 transition ease-in-out duration-150 dark:bg-indigo-700 dark:hover:bg-indigo-800">
                        <svg class="w-5 h-5 fill-current text-gray-900 dark:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Ticket Details
                    </button>
                </div>
                
                
            </form> {{-- End Form --}}

        </div> {{-- End Card --}}

        {{-- Solutions Section --}}
        @if(isset($solutions))
            <div class="mt-8"> {{-- Added margin top for separation --}}
                 @include('admin.partials.display_solutions', ['solutions' => $solutions])
            </div>
        @else
            {{-- Optional: Add a placeholder if solutions aren't always expected --}}
             {{-- <div class="mt-8 text-center text-gray-500 dark:text-gray-400">No solutions available for this ticket yet.</div> --}}
        @endif

    </div> {{-- End Container --}}
@endsection