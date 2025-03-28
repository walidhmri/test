@extends('layouts.admin')
@section('title','Tickets List')
@section('content')
<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">خطأ!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">نجاح!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        

        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Liste des Tickets
        </h2>
        <div>
            <form method="post" action="{{ route('admin.tickets.filter') }}" class="dark:bg-gray-900 p-4 rounded-lg">
                @csrf  
                <select class="bg-gray-800 border border-gray-600 text-gray-200 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="priority">
                    <option value="" {{ request('priority') == '' ? 'selected' : '' }}>All</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                    <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
            
                <select class="bg-gray-800 border border-gray-600 text-gray-200 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="status">
                    <option value="" {{ request('status') == '' ? 'selected' : '' }}>All</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="solved" {{ request('status') == 'solved' ? 'selected' : '' }}>Solved</option>
                </select>
            
                <select class="bg-gray-800 border border-gray-600 text-gray-200 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="employee_id">
                    <option value="" {{ request('employee_id') == '' ? 'selected' : '' }}>All</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
                <input type="month" name="month" id="month"
                value="{{ request('month') }}"
                class="bg-gray-800  border border-gray-600 
                       rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 
                       focus:border-blue-500 outline-none transition duration-200">

                <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                    Filter
                </button>
            </form>
            
        </div>
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Ticket Title</th>
                    <th class="px-4 py-3">Employee </th>
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
                            <div class="min-w-0 max-w-full">
                                {{ \Illuminate\Support\Str::words($ticket->title, 5, '...') }}                                <p class="text-xs text-gray-600 dark:text-gray-400 truncate">
                                    {{ $ticket->role }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                    {{ $employees->where('id',$ticket->user_id)->first()->name }}
                    <td class="px-4 py-3 text-xs">

                        <span style="
                            @switch($ticket->status)
                            @case('pending') background-color:orange; @break
                            @case('closed') background-color:brown; @break
                            @case('solved') background-color:green; @break
                            @default background-color:gray;
                        @endswitch
                            
                            
                " class="px-2 py-1 font-semibold leading-tight rounded-full 
                    
                             text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100">
                        
                        {{$ticket->status}}
                    </span>
                    </td>
                    <td class="px-4 py-3 text-xs">

                        <span class="px-2 py-1 font-semibold leading-tight rounded-full 
                        @switch($ticket->priority)
                            @case('low') text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100 @break
                            @case('medium') text-yellow-700 bg-yellow-100 dark:bg-yellow-700 dark:text-yellow-100 @break
                            @case('high') text-dark-700 bg-orange-100 dark:bg-orange-700 dark:text-dark-700 @break
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
                            <button type="submit" onclick="window.location='{{ route('admin.tickets.show', ['id' => $ticket->id,'user_id'=>$ticket->user_id]) }}'"
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
    </div>
    <div class="flex justify-center mt-4">
        {{ $tickets->links() }}
    </div>

</div>
@endsection