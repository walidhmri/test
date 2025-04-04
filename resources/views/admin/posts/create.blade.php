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
        <form method="POST" action="{{ route('admin.post.store') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{auth::get()->user()->name}}">
            <label class="block text-sm">
                <span class="text-gray-400 dark:text-gray-400">Name</span>
                <input name="name" type="text" value="{{ old('name') }}" required autofocus class="block w-full text-gray-400 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 form-input" placeholder="exemple :Hardware post" />
                @error('name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </label>
@push('head')
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: 'textarea#tiny',
            plugins: [
              'a11ychecker', 'accordion', 'advlist', 'anchor', 'autolink', 'autosave',
              'charmap', 'code', 'codesample', 'directionality', 'emoticons', 'exportpdf',
              'exportword', 'fullscreen', 'help', 'image', 'importcss', 'importword',
              'insertdatetime', 'link', 'lists', 'markdown', 'math', 'media', 'nonbreaking',
              'pagebreak', 'preview', 'quickbars', 'save', 'searchreplace', 'table',
              'visualblocks', 'visualchars', 'wordcount'
            ],
            toolbar: 'undo redo | accordion accordionremove | ' +
              'importword exportword exportpdf | math | ' +
              'blocks fontfamily fontsize | bold italic underline strikethrough | ' +
              'align numlist bullist | link image | table media | ' +
              'lineheight outdent indent | forecolor backcolor removeformat | ' +
              'charmap emoticons | code fullscreen preview | save print | ' +
              'pagebreak anchor codesample | ltr rtl',
            menubar: 'file edit view insert format tools table help'
      })
    </script>
@endpush

            <div>
                <textarea id="tiny"></textarea>
            </div>
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Description</span>
                <textarea name="description" required class="block w-full mt-1 text-gray-400 text-sm dark:border-gray-600 dark:bg-gray-700 form-textarea" placeholder="Example: ce post....."></textarea>
                @error('description') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
            </label>

            <button type="submit"
            class="flex items-center justify-center w-full px-4 py-2 mt-4 text-sm font-medium text-gray-900 dark:text-white border border-blue-600 dark:border-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current text-gray-900 dark:text-white"
                viewBox="0 0 20 20">
                <path
                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7A1 1 0 003 11h4v5a1 1 0 001 1h4a1 1 0 001-1v-5h4a1 1 0 00.707-1.707l-7-7z" />
            </svg>
        
            <span class="ml-2">Ajouter un post</span>
        </button>
        </form>
    </div>
</div>
@endsection
