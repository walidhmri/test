@extends('layouts.admin')
@section('title', 'Show Profile')
@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Profile Information</h2>
        </div>
        <div class="border-t border-gray-200 dark:border-gray-700">
            <dl>
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Full name</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                        {{ $employee->name }}
                    </dd>
                </div>
                <div class="bg-white dark:bg-gray-800 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Email address</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                        {{ $employee->email }}
                    </dd>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Role</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                        {{ $employee->role }}
                    </dd>
                </div>
                <div class="bg-white dark:bg-gray-800 px-6 py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-300">Created At</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                        {{ $employee->created_at }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Employee Tickets</h2>
        
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Ticket ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Created At</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($tickets as $ticket)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ $ticket->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ $ticket->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ $ticket->status }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ $ticket->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($tickets->isEmpty())
        <p class="text-gray-600 dark:text-gray-400">No tickets found for this employee.</p>
        @endif
    </div>
</div>
@endsection