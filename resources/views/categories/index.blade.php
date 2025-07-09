@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Categories</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <div class="mb-4 text-right">
        {{-- Menggunakan nama rute admin yang benar --}}
        <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add Category</a>
    </div>

    <table class="w-full bg-white shadow-md rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="text-left px-4 py-2">Name</th>
                <th class="text-center px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $category->name }}</td>
                    <td class="px-4 py-2 text-center">
                        {{-- Menggunakan nama rute admin yang benar --}}
                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection