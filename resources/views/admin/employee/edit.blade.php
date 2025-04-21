@extends('layouts.admin')
@section('title')
edit {{$employee->name}}
@endsection
@section('content')
<div class="container px-6 mx-auto grid">
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">هناك أخطاء في الإدخال:</strong>
        <ul class="mt-2">
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Edit Profile Information 

        <button type="button" onclick="window.location='{{ route('admin.profile.password', ['id' => $employee->id]) }}'"
            class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
            aria-label="Edit Password">
            <svg class="w-5 h-5 mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C8.13 2 5 5.13 5 9v2H4a2 2 0 00-2 2v8a2 2 0 002 2h16a2 2 0 002-2v-8a2 2 0 00-2-2h-1V9c0-3.87-3.13-7-7-7zm-3 9V9a3 3 0 016 0v2H9zm10 2v8H5v-8h14z" />
            </svg>
            <span>@lang('messages.editpassword')</span>
        </button>
        

    </h2>
    <div class="mt-4 text-gray-500 dark:text-gray-300 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-2a6 6 0 100-12 6 6 0 000 12zm0-6a1 1 0 011-1h1a1 1 0 110 2h-1a1 1 0 01-1-1zm0-3a1 1 0 011-1h1a1 1 0 110 2h-1a1 1 0 01-1-1zm0 6a1 1 0 011-1h1a1 1 0 110 2h-1a1 1 0 01-1-1z" clip-rule="evenodd" />
        </svg>
         <a href="{{ route('admin.profile.show', ['id' => $employee->id]) }}" class="text-blue-500 hover:text-blue-700">  {{ $employee->name }} Profile</a>
    </div>
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="success">
        <strong class="font-bold">success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif


    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form method="POST" action="{{ route('admin.employee.edit', $employee->id) }}">
            @csrf
            @method('PATCH')
        
            <input type="hidden" name="id" value="{{ $employee->id }}">
        
            <label class="block text-sm">
                <span class="text-gray-400 dark:text-gray-400">الاسم</span>
                <input name="name" type="text" value="{{ $employee->name }}" required autofocus class="block w-full text-gray-400 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input" placeholder="مثال: محمد أحمد" />
                @error('name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </label>
        
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">البريد الإلكتروني</span>
                <input name="email" type="string" value="{{ $employee->email }}" required class="block w-full mt-1 text-gray-400 text-sm dark:border-gray-600 dark:bg-gray-700 form-input" placeholder="مثال: user@example.com" />
                @error('email') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </label>
            
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">الدور (Role)</span>
                <select name="role" required class="block w-full mt-1 text-gray-400 text-sm dark:border-gray-600 dark:bg-gray-700 form-select">
                    <option value="admin" {{ $employee->role === 'admin' ? 'selected' : '' }}>مدير</option>
                    <option value="user" {{ $employee->role === 'user' ? 'selected' : '' }}>موظف</option>
                    <option value="ingenieur" {{ $employee->role === 'ingenieur' ? 'selected' : '' }}>مهندس</option>
                </select>
                @error('role') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </label>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Department if enginner <span style="color: red">*</span>
                </label>
                <select id="department" name="department"
                    class="block w-full rounded-lg border-2 border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:border-purple-500 focus:ring-2 focus:ring-purple-500 appearance-none">
                    <option value="" disabled {{ old('department_id', '') ? '' : 'selected' }}>
                        -- Select a department --
                    </option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                @error('department') <p class="text-red-500 dark:text-red-400 text-xs mt-2">{{ $message }}</p> @enderror
            </div>
        
            <button type="submit"
            class="flex items-center justify-center w-full px-4 py-2 mt-4 text-sm font-medium text-gray-900 dark:text-white border border-blue-600 dark:border-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition ease-in-out duration-150">
            
            <!-- أيقونة النشر -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current text-gray-900 dark:text-white" viewBox="0 0 20 20">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7A1 1 0 003 11h4v5a1 1 0 001 1h4a1 1 0 001-1v-5h4a1 1 0 00.707-1.707l-7-7z"/>
            </svg>
    
            <span class="ml-2">Save Changes</span>
        </button>
        </form>
        
    </div>
</div>
@endsection