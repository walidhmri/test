@extends('layouts.admin')
@section('title')
Liste des ingenieurs
@endsection
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
        <script>
            alert('{{ session('success') }}'); </script>
        @endif
        
        <div class="flex justify-end p-4">
            <div class="fixed bottom-4 right-4">
                <a class="flex items-center justify-center w-12 h-12 bg-purple-600 hover:bg-purple-700 rounded-full" href="{{route('admin.employee.ajouter')}}">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 00-1 1v5H4a1 1 0 100 2h5v5a1 1 0 102 0v-5h5a1 1 0 100-2h-5V4a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </a>
                <p class="text-sm text-gray-500">@lang('messages.add_ingenieur')</p>
            </div>
        </div>
        
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> @lang('messages.list_ingenieurs')
        </h2>
        <form action="{{ route('admin.ingenieurs.list') }}" method="GET" class="flex items-center space-x-2 bg-white dark:bg-gray-800 p-2 rounded-lg shadow-md">
            <input 
                type="text" 
                name="search" 
                placeholder="Search employee by name or role..." 
                value="{{ request()->search }}"
                class="w-full px-4 py-2 text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
            >
            
            <button type="submit" class="px-4 py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                <svg class="w-6 h-6 text-gray-900 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4a6 6 0 014.472 9.528l4.75 4.75a1 1 0 11-1.414 1.414l-4.75-4.75A6 6 0 1110 4z" />
                </svg>
            </button>
            
        </form>
  
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide  text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">@lang('messages.ingenieur')</th>
                    <th class="px-4 py-3">@lang('messages.id')</th>
                    <th class="px-4 py-3">@lang('messages.status')</th>
                    <th class="px-4 py-3">@lang('messages.date')</th>
                    <th class="px-4 py-3">@lang('messages.actions')</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                
                @foreach($employees as $employee)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->

                            <div>
                                <p class="font-semibold">{{ $employee->name }}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                     @if($employee->role == 'user')
                                     Employee
                                        @elseif($employee->role == 'admin')
                                        Administrateur
                                        @else
                                        ingenieur
                                        @endif
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                       {{$employee->email}}
                    </td>
                    <td class="px-4 py-3 text-xs">
                        <span
                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            Approved
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $employee->created_at->format('Y-m-d') }}
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                            <button type="submit" onclick="window.location='{{ route('admin.employee.editemployee', ['id' => $employee->id]) }}'"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Edit">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                    </path>
                                </svg>
                            </button>


                            <button type="submit" onclick="window.location='{{ route('admin.profile.show', ['id' => $employee->id]) }}'"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Edit">
                                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.761 0 5-2.239 5-5S14.761 2 12 2 7 4.239 7 7s2.239 5 5 5zm0 2c-3.33 0-10 1.67-10 5v2h20v-2c0-3.33-6.67-5-10-5z"/>
                                </svg>
                            </button>


                            <form method="post" action="{{route('admin.employee.delete')}}">
                                <input type="hidden" name="id" value="{{ $employee->id }}">
                            @method('DELETE')
                                @csrf
                            <button onclick="return confirm('Vous voulez supprimer {{ $employee->name }}?')"
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
    @if (count($employees) == 0)
        
    <div class="flex justify-center mt-4">
        <p class="text-gray-500">Aucun ingenieur trouvé</p>
    </div>
    @endif
    <div class="flex justify-center mt-4">
        {{ $employees->links() }}
    </div>

</div>
@endsection
