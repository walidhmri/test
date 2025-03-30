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
    @lang('messages.editpassword')    
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
        <form method="POST" action="{{ route('admin.profile.passwordupdate', $employee->id) }}">
            @csrf
            @method('PATCH')
@include('admin.partials.form_password')
        </form>
    </div>
</div>
@endsection