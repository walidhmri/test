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
        Create new Department
    </h2>
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form method="POST" action="{{ route('admin.department.store') }}">
            @csrf
            <input type="hidden" name="manager_id" value="1">
            <label class="block text-sm">
                <span class="text-gray-400 dark:text-gray-400">Name</span>
                <input name="name" type="text" value="{{ old('name') }}" required autofocus class="block w-full text-gray-400 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input" placeholder="exemple :Hardware department" />
                @error('name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </label>




@push('head')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

<div class="w-full max-w-xl mx-auto">
    <label for="editor" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Content</label>
    <div id="editor" class="h-40 bg-white dark:bg-gray-800 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm"></div>
    <input type="hidden" name="content" id="content">
</div>


            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Description</span>
                <textarea name="description" required class="block w-full mt-1 text-gray-400 text-sm dark:border-gray-600 dark:bg-gray-700 form-textarea" placeholder="Example: ce department....."></textarea>
                @error('description') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </label>

            <button type="submit"
            class="flex items-center justify-center w-full px-4 py-2 mt-4 text-sm font-medium text-gray-900 dark:text-white border border-blue-600 dark:border-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current text-gray-900 dark:text-white"
                viewBox="0 0 20 20">
                <path
                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7A1 1 0 003 11h4v5a1 1 0 001 1h4a1 1 0 001-1v-5h4a1 1 0 00.707-1.707l-7-7z" />
            </svg>
        
            <span class="ml-2">Ajouter un department</span>
        </button>
        </form>
    </div>
</div>


<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Write something...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    quill.on('text-change', function() {
        document.querySelector('#content').value = quill.root.innerHTML;
    });
</script>

@endsection
