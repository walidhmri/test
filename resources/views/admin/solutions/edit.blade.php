@extends('layouts.admin')

@section('title', 'Edit Solution')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Session Messages --}}
    @include('admin.partials.session')

    {{-- Breadcrumbs --}}
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('admin.Tickets.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Tickets</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('admin.Tickets.show', ['id' => $solution->ticket_id]) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Ticket #{{ $solution->ticket_id }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Edit Solution</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Main Content --}}
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                Edit Solution
            </h2>
        </div>

        <form method="POST" action="{{ route('admin.solutions.update', ['id' => $solution->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="p-6 space-y-6">
                {{-- Title Field --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title', $solution->title) }}" required
                           class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white sm:text-sm">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description Field --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Description
                    </label>
                    <textarea name="description" id="description" rows="3"
                              class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white sm:text-sm">{{ old('description', $solution->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Current File (if exists) --}}
                @if(!empty($solution->file))
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current File</h4>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-8 h-8 bg-indigo-100 dark:bg-indigo-900 rounded border border-indigo-200 dark:border-indigo-800 flex items-center justify-center text-indigo-500 dark:text-indigo-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ basename($solution->file) }}
                                </p>
                                <div class="flex mt-1 space-x-3">
                                    <a href="{{ asset('storage/' . $solution->file) }}" download class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">
                                        Download
                                    </a>
                                    <a href="{{ asset('storage/' . $solution->file) }}" target="_blank" class="text-xs text-gray-600 dark:text-gray-400 hover:underline">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="flex items-center">
                                <input id="keep_file" name="keep_file" type="checkbox" checked
                                       class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700">
                                <label for="keep_file" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Keep current file
                                </label>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Uncheck this option if you want to replace the current file with a new one.
                            </p>
                        </div>
                    </div>
                @endif

                {{-- File Upload Field --}}
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        {{ !empty($solution->file) ? 'Replace File' : 'Upload File' }}
                    </label>
                    <input type="file" name="file" id="file"
                           class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 dark:file:bg-indigo-900 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Accepted file types: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG, ZIP (max 10MB)
                    </p>
                    @error('file')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tags Field (Optional) --}}
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Tags (comma separated)
                    </label>
                    <input type="text" name="tags" id="tags" value="{{ old('tags', $solution->tags) }}"
                           class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white sm:text-sm">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Example: hardware, software, network
                    </p>
                    @error('tags')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-3">
                <a href="{{ route('admin.Tickets.show', ['id' => $solution->ticket_id]) }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-900">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-700 dark:hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-900">
                    Update Solution
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle file upload visibility based on keep_file checkbox
    const keepFileCheckbox = document.getElementById('keep_file');
    const fileInput = document.getElementById('file');
    const fileInputContainer = fileInput ? fileInput.parentElement : null;
    
    if (keepFileCheckbox && fileInputContainer) {
        // Initial state
        fileInputContainer.style.opacity = keepFileCheckbox.checked ? '0.5' : '1';
        fileInput.disabled = keepFileCheckbox.checked;
        
        // Handle change
        keepFileCheckbox.addEventListener('change', function() {
            fileInputContainer.style.opacity = this.checked ? '0.5' : '1';
            fileInput.disabled = this.checked;
            
            if (!this.checked) {
                fileInput.focus();
            }
        });
    }
    
    // Check for dark mode
    function updateTheme() {
        const isDarkMode = localStorage.getItem('dark') === 'true';
        if (isDarkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
    
    // Initial theme check
    updateTheme();
    
    // Listen for theme changes
    window.addEventListener('storage', function(e) {
        if (e.key === 'dark') {
            updateTheme();
        }
    });
});
</script>
@endpush