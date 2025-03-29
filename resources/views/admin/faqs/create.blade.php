@extends('layouts.admin')
@section('title')
Create new FAQ
@endsection
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
        Create new FAQ
    </h2>
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form method="POST" action="{{ route('admin.faq.store') }}">
            @csrf
            <label class="block text-sm">
                <span class="text-gray-400 dark:text-gray-400">Question</span>
                <input name="question" type="text" value="{{ old('question') }}" required autofocus class="block w-full text-gray-400 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input" placeholder="Example: What is the FAQ about?" />
                @error('question') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </label>

            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Answer</span>
                <textarea name="answer" required class="block w-full mt-1 text-gray-400 text-sm dark:border-gray-600 dark:bg-gray-700 form-textarea" placeholder="Example: This is the answer to the FAQ."></textarea>
                @error('answer') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </label>

            <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
                @lang('messages.add_faq')
            </button>
        </form>
    </div>
</div>
@endsection
