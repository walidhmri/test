@extends('layouts.admin')

@section('title', 'Ticket Details - #' . $ticket->id) {{-- More specific title --}}

@section('content')

@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@elseif (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>  

@endif


    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-4 flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
                    Ticket #{{ $ticket->id }} Information                         
                </h2>

                <a href="{{ route('pdf.ticket', ['id' => $ticket->id]) }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block text-center transition duration-150 ease-in-out">
                    Download PDF
                </a>
                <a href="{{ route('pdf.ticket', ['id' => $ticket->id]) }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block text-center transition duration-150 ease-in-out">
solve                </a>
            </div>

            {{-- Form for Updates --}}
            {{-- Replace '#' with your actual update route --}}
            <form method="POST" action="{{route('admin.tickets.update',['id' => $ticket->id])}}"> {{-- Assuming route name --}}
                @csrf
                @method('PATCH') {{-- Or PUT --}}

                <div class="border-t border-gray-200 dark:border-gray-700">
                    <dl>
                        {{-- Title --}}
                        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Title</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                {{ $ticket->title }}
                            </dd>
                        </div>

                        {{-- Description --}}
                        <div class="bg-white dark:bg-gray-800 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                {{-- Use nl2br for line breaks if description can have them --}}
                                <a href="{{ route('admin.profile.show', ['id' => $employee->id]) }}">{{ $employee->name}}</a> 
                            </dd>
                        </div>




                        {{-- Status --}}
                        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 items-center">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Status</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2">
                                <select name="status" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-200 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="pending" @selected($ticket->status == 'pending')>Pending</option>
                                    <option value="solved" @selected($ticket->status == 'solved')>Solved</option>
                                    <option value="closed" @selected($ticket->status == 'closed')>Closed</option>
                                </select>
                            </dd>
                        </div>

                        {{-- Priority --}}
                        <div class="bg-white dark:bg-gray-800 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4 items-center">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Priority</dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2">
                                <select name="priority" class="w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-200 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="low" @selected($ticket->priority == 'low')>Low</option>
                                    <option value="medium" @selected($ticket->priority == 'medium')>Medium</option>
                                    <option value="high" @selected($ticket->priority == 'high')>High</option>
                                    <option value="urgent" @selected($ticket->priority == 'urgent') class="text-red-600 dark:text-red-400 font-semibold">Urgent</option>
                                </select>
                            </dd>
                        </div>

                        {{-- Created At --}}
                        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Created At</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                {{ $ticket->created_at->format('F j, Y H:i:s') }} {{-- Example format --}}
                                ({{ $ticket->created_at->diffForHumans() }}) {{-- Relative time --}}
                            </dd>
                        </div>

                        {{-- Attachment --}}
                        <div class="bg-white dark:bg-gray-800 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Attachment</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                @if ($ticket->file)
                                    {{-- Consider checking file type for better display (e.g., link vs img) --}}
                                    <img src="{{ asset('storage/' . $ticket->file) }}" alt="Ticket attachment preview" class="max-w-xs max-h-48 rounded border border-gray-300 dark:border-gray-600 mb-2">
                                    <a href="{{ asset('storage/' . $ticket->file) }}" download class="text-blue-500 hover:underline text-sm">
                                        Download Attachment
                                    </a>
                                @else
                                    <span class="text-gray-500 dark:text-gray-400 italic">No file attached</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>

                {{-- Form Actions / Footer --}}
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 text-right">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800 transition duration-150 ease-in-out">
                        Update Ticket
                    </button>
                </div>

            </form> {{-- End Form --}}

        </div> {{-- End Card --}}
    </div> {{-- End Container --}}
@endsection