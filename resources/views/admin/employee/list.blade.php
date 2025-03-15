@extends('layouts.admin')
@section('title')
Liste des employees
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
                <p class="text-sm text-gray-500">Ajouter un employee</p>
            </div>
        </div>
        
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Liste des employees
        </h2>
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Employee</th>
                    <th class="px-4 py-3">Id </th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Actions</th>
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
                       {{$employee->id}}
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
    <div class="flex justify-center mt-4">
        {{ $employees->links() }}
    </div>

</div>
@endsection
