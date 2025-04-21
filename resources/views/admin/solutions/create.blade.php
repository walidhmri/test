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
        Create solution for Ticket #{{ $ticket->id }}
    </h2>
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form method="POST" action="{{ route('admin.Ticket.solution.store',['id',$ticket->id]) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="Ticket_id" value="{{ $ticket->id }}">
            <input type="hidden" name="user_id" value="{{ $ticket->user_id }}">

           @include('admin.partials.form_solution')
        </form>
    </div>
</div>
@endsection
