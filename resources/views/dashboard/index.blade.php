@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">📊 Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-xl font-semibold text-gray-700">Total Books</h2>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalBooks }}</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-xl font-semibold text-gray-700">Users</h2>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalUsers }}</p>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-xl font-semibold text-gray-700">Total Ratings</h2>
            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $totalRatings }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-xl font-semibold text-gray-700">Categories</h2>
            <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalCategories }}</p>
        </div>
    </div>
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">📘 Top Rated Books</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($topBooks as $book)
            <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-all flex">
                <img src="{{ $book->image_url }}" alt="{{ $book->title }}"
                    class="w-20 h-28 object-cover rounded mr-4">
                <div class="flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-500">by {{ $book->authors }}</p>
                    </div>
                    <div class="mt-2 flex items-center justify-between text-sm">
                        <span class="text-yellow-600 font-bold">⭐ {{ number_format($book->ratings_avg_rating, 2) }}</span>

                        @if ($book->category)
                            <span class="bg-purple-100 text-purple-800 px-2 py-0.5 rounded-full text-xs font-medium">
                                {{ $book->category->name }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    {{-- Next section: top books, latest ratings, etc --}}
@endsection
