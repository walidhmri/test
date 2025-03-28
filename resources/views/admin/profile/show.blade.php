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
            </button></h2>

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
    @if($employee->role == 'user')
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Employee Tickets</h2>
        
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Ticket Title</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Priority</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($tickets as $ticket)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->

                            <div>
                                <p class="font-semibold"> {{ \Illuminate\Support\Str::words($ticket->title, 4, '...') }} </p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    {{ $ticket->role }}
                                </p>
                            </div>
                        </div>
                    </td>
                   
                    <td class="px-4 py-3 text-xs">

                        <span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            {{$ticket->status}}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-xs">

                        <span class="px-2 py-1 font-semibold leading-tight rounded-full 
                        @switch($ticket->priority)
                            @case('low') text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100 @break
                            @case('medium') text-yellow-700 bg-yellow-100 dark:bg-yellow-700 dark:text-yellow-100 @break
                            @case('high') text-dark-700 bg-orange-100 dark:bg-orange-100 dark:text-dark-100 @break
                            @case('urgent') text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100 @break
                            @default text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100
                        @endswitch">
                        {{$ticket->priority}}
                    </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $ticket->created_at->format('Y-m-d') }}
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                            <button type="submit" onclick="window.location='{{ route('admin.tickets.show', ['id' => $ticket->id,'user_id'=>$employee->id]) }}'"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Edit">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                    </path>
                                </svg>
                            </button>


                      


                            <form method="post" action="{{route('admin.tickets.delete',$ticket->id)}}">
                            @method('DELETE')
                                @csrf
                            <button onclick="return confirm('Vous voulez supprimer {{ $ticket->title }}?')"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Delete">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            </form>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($tickets->isEmpty())
        <p class="text-gray-600 dark:text-gray-400">No tickets found for this employee.</p>
        @endif
    
    </div>
    @elseif($employee->role == 'ingenieur')
    <div class="px-6 py-4">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Enginner solutions</h2>
    </div>
    @endif

</div>
@endsection