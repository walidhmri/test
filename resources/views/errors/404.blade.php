@extends('layouts.guest')
@section('title', '404 Not Found')
@section('content')
    <div class="container mx-auto text-center py-20">
        <h1 class="text-4xl font-bold mb-4">404 Not Found</h1>
        <p class="text-lg mb-8">Sorry, the page you are looking for does not exist.</p>
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline">Return to Home</a>   
    </div>

@endsection   