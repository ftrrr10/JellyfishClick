@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Book List</h1>

    <!-- Filter Dropdown -->
    <form method="GET" action="{{ route('books.index') }}" class="mb-6">
        <div class="flex items-center gap-4">
            <label for="category" class="text-sm font-medium text-gray-700">Filter by Category:</label>
            <select name="category" id="category" onchange="this.form.submit()" class="border-gray-300 rounded px-3 py-2">
                <option value="">-- All Categories --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <!-- [ PERBAIKAN 1: Tombol Tambah Buku Hanya untuk Admin ] -->
    @if (auth()->user() && auth()->user()->isAdmin())
        <div class="mb-4 text-right">
            <!-- [ PERBAIKAN 2: Menggunakan Nama Rute Admin yang Benar ] -->
            <a href="{{ route('admin.books.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Add Book</a>
        </div>
    @endif

    <!-- Book Table -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Cover</th>
                    <th class="text-left px-4 py-2">Title</th>
                    <th class="text-left px-4 py-2">Category</th>
                    <th class="text-left px-4 py-2">Rating</th>
                    <!-- [ PERBAIKAN 3: Kolom Aksi Hanya untuk Admin ] -->
                    @if (auth()->user() && auth()->user()->isAdmin())
                        <th class="text-center px-4 py-2">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">
                            <img src="{{ $book->image_url }}" alt="cover" class="w-12 h-16 object-cover rounded">
                        </td>
                        <td class="px-4 py-2">
                            <div class="font-semibold text-gray-800">{{ $book->title }}</div>
                            <div class="text-sm text-gray-500">by {{ $book->authors }}</div>
                        </td>
                        <td class="px-4 py-2">
                            @if($book->category)
                                <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded-full">
                                    {{ $book->category->name }}
                                </span>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">⭐ {{ number_format($book->average_rating, 2) ?? '-' }}</td>
                        
                        <!-- [ PERBAIKAN 4: Tombol Aksi Hanya untuk Admin & Menggunakan Rute yang Benar ] -->
                        @if (auth()->user() && auth()->user()->isAdmin())
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('admin.books.edit', $book) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $books->links('pagination::tailwind') }}
    </div>
@endsection