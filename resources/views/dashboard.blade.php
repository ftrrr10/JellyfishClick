@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Welcome, {{ auth()->user()->name }}!</h1>
    <p class="text-gray-600">This is your dashboard. Use the sidebar to navigate through the admin panel.</p>
@endsection
