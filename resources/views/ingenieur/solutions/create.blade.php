@extends('layouts.ingenieur')
@section('title','Add solution')
@section('content')
@section('content')
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Input Errors:</strong>
        <ul class="mt-2">
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Create solution for ticket #{{ $ticket->id }}
    </h2>
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form method="POST" action="{{ route('ingenieur.ticket.solution.store') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $ticket->id }}">
            <input type="hidden" name="user_id" value="{{ $ticket->user_id }}">
            <div class="space-y-4">
                <!-- حقل العنوان -->
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                    Title
                    <input name="title" type="text" placeholder="Enter title" required
                        class="block w-full mt-1 px-3 py-2 text-gray-900 dark:text-gray-300 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 transition ease-in-out duration-150" />
                </label>
            
                <!-- حقل الوصف -->
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                    Description
                    <textarea name="description" placeholder="Enter description"
                        class="block w-full mt-1 px-3 py-2 text-gray-900 dark:text-gray-300 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 transition ease-in-out duration-150"></textarea>
                </label>
            
                <!-- حقل الملف -->
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                    File
                    <input name="file" type="file"
                        class="block w-full mt-1 text-gray-900 dark:text-gray-300 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 transition ease-in-out duration-150" />
                </label>
            
                <!-- زر الإرسال -->
                <button type="submit"
                    class="flex items-center justify-center w-full px-4 py-2 mt-4 text-sm font-medium text-gray-900 dark:text-white border border-blue-600 dark:border-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition ease-in-out duration-150">
                    
                    <!-- أيقونة النشر -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current text-gray-900 dark:text-white" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7A1 1 0 003 11h4v5a1 1 0 001 1h4a1 1 0 001-1v-5h4a1 1 0 00.707-1.707l-7-7z"/>
                    </svg>
            
                    <span class="ml-2">Post</span>
                </button>
            <div>
        </form>
    </div>
</div>
@endsection
@endsection