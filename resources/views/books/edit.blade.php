@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Book</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <form action="{{ route('admin.books.update', $book) }}" method="POST" class="space-y-6 bg-white shadow-xl rounded-xl p-8">
        @csrf
        @method('PATCH') 

        <div>
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" value="{{ $book->title }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Author(s)</label>
            <input type="text" name="authors" value="{{ $book->authors }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category_id" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Publication Year</label>
            <input type="number" name="publication_year" value="{{ $book->publication_year }}" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">ISBN</label>
            <input type="text" name="isbn" value="{{ $book->isbn }}" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Cover Image URL</label>
            <input type="url" name="image_url" value="{{ $book->image_url }}" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Average Rating</label>
            <input type="number" step="0.1" name="average_rating" value="{{ $book->average_rating }}" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="flex items-center justify-between">
            
            <a href="{{ route('admin.books.index') }}" class="text-blue-600 hover:underline">Back</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
@endsection