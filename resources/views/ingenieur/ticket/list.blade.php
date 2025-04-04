@extends('layouts.ingenieur')
@section('title', 'Tickets List')
@section('content')
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">خطأ!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">نجاح!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif


            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Liste des Tickets
            </h2>
            <div>
                <form method="get" action="{{ route('admin.tickets.list') }}"
                    class="p-4 rounded-lg bg-white dark:bg-gray-900 shadow-md">

                    <select
                        class="border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                               bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600"
                        name="priority">
                        <option value="" {{ request('priority') == '' ? 'selected' : '' }}>All</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>

                    <select
                        class="border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                               bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600"
                        name="status">
                        <option value="" {{ request('status') == '' ? 'selected' : '' }}>All</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="solved" {{ request('status') == 'solved' ? 'selected' : '' }}>Solved</option>
                    </select>
                <select
                    class="border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                           bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600"
                    name="assign">
                    <option value="" {{ request('assign') == '' ? 'selected' : '' }}>All</option>
                    <option value="true" {{ request('assign') == 'true' ? 'selected' : '' }}>Assigned</option>
                    <option value="false" {{ request('assign') == 'false' ? 'selected' : '' }}>Not Assigned</option>
                </select>
                    <select
                        class="border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                               bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600"
                        name="employee_id">
                        <option value="" {{ request('employee_id') == '' ? 'selected' : '' }}>All</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>

                    <input type="month" name="month" id="month" value="{{ request('month') }}"
                        class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 
                              focus:border-blue-500 outline-none transition duration-200
                              bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600">

                    <select
                        class="border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                              bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600"
                        name="order">
                        <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Last created</option>
                        <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>First Created</option>
                    </select>
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded transition duration-200
                @if (config('app.theme') === 'dark') dark:bg-gray-700 dark:text-gray-100
                @else
                    bg-white text-gray-700 @endif">
                        <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Filter
                    </button>
                </form>


            </div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide  text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">@lang('messages.ticket_title')</th>
                        <th class="px-4 py-3">@lang('messages.employee')</th>
                        <th class="px-4 py-3">id</th>
                        <th class="px-4 py-3">@lang('messages.assigned')</th>
                        <th class="px-4 py-3">@lang('messages.status')</th>
                        <th class="px-4 py-3">@lang('messages.priority')</th>
                        <th class="px-4 py-3">@lang('messages.date')</th>
                        <th class="px-4 py-3">@lang('messages.actions')</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($tickets as $ticket)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div class="min-w-0 max-w-full dark:text-gray-200">
                                        {{ \Illuminate\Support\Str::words($ticket->title, 5, '...') }} <p
                                            class="text-xs text-gray-600 dark:text-gray-400 truncate">
                                            {{ $ticket->role }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            @push('styles')
                            <style>
                            .emp{
                                text-decoration:underline; 
                            
                            }
                            .emp:hover{
                                color:rgb(128, 0, 255);
                                text-decoration:none;
                            }
                            </style>
                             
                            @endpush
                            <!-- employee ici-->
                            <td style="" class="px-4 py-3 text-sm">
                               <a class="emp" href="{{route('admin.profile.show', ['id'=>$ticket->user_id])}}"> {{ $employees->where('id', $ticket->user_id)->first()->name }}</a>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $ticket->id }}
                            </td>
                            <td class="px-4 py-3 text-sm">

                                @php
                                 if($ticket->assign != null){
                                    echo 'Assigned';
                                 } 
                                 else{
                                    echo 'Not Assigned';
                                 }
                                @endphp

                            </td>
                            <td class="px-4 py-3 text-xs">


                                <span   style="@if($ticket->status=='pending') 
                                   border:2px solid yellow;
                                   @elseif($ticket->status=='solved')
                                   border:2px solid green;
                                   @elseif($ticket->status=='closed')
                                      border:2px solid violet;
                                   @endif
                                   " 

                                    class="px-2 py-1 font-semibold leading-tight rounded-full 
                    
                             text-gray-700  dark:bg-gray-700 dark:text-gray-100
                             
                             @switch($ticket->status)
                             @case('pending') text-dark-700 bg-orange-100 dark:bg-blue-700 dark:text-orange-100 @break
                             @case('solved') text-dark-700 bg-green-100 dark:bg-green-700 dark:bg-red-700 dark:text-green-100 @break
                             @case('closed') text-dark-700 bg-dark-100 dark:bg-white-700 dark:text-dark-700 @break
                             @default text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100
                         @endswitch">


                                    {{ $ticket->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-xs">

                                <span  @if($ticket->priority=='medium')
                                style=" border:2px solid orange;" 
                                @elseif($ticket->priority=='low')
                                style=" border:2px solid green;" 
                                @elseif($ticket->priority=='high')
                                style=" border:2px solid rgba(255, 0, 0, 0.6);                                ;"
                                @elseif($ticket->priority=='urgent')
                                style=" border:2px solid red;"
                                @endif
                               
                                class="px-2 py-1 font-semibold leading-tight rounded-full 
                    
                                text-gray-700  dark:bg-gray-700 dark:text-gray-100
                                
                        @switch($ticket->priority)
                            @case('low') text-green-700 bg-green-100  dark:bg-green-700 dark:text-orange-100 @break
                            @case('high') text-white-100 dark:text-white-100  @break
                            @case('urgent') text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100 @break
                            @case('medium') text-orange-700 bg-orange-100 dark:bg-orange-700 dark:text-dark-100 @break
                            @default text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100
                        @endswitch">
                                    {{ $ticket->priority }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $ticket->created_at->format('Y-m-d') }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button type="submit"
                                        onclick="window.location='{{ route('admin.tickets.show', ['id' => $ticket->id, 'user_id' => $ticket->user_id]) }}'"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </button>


                                    <form method="post" action="{{ route('admin.tickets.delete', $ticket->id) }}">
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
        </div>
        @if (count($tickets) == 0)
            <div class="flex justify-center mt-4">
                <p class="text-gray-500">Aucun Ticket trouvé</p>
            </div>
        @endif
        <div class="flex justify-center mt-4">
            {{ $tickets->appends(request()->query())->links() }}
        </div>

    </div>
@endsection
