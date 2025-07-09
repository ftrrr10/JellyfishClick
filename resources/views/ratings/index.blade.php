@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">User Ratings</h1>

    <form method="GET" action="{{ route('ratings.index') }}" class="mb-4">
        <input type="text" name="book" value="{{ request('book') }}"
            class="border-gray-300 rounded px-3 py-2 w-64"
            placeholder="Filter by book title..." />
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded ml-2 hover:bg-blue-700">
            Filter
        </button>
    </form>


    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">User</th>
                    <th class="py-3 px-6 text-left">Book Title</th>
                    <th class="py-3 px-6 text-center">Rating</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse ($ratings as $rating)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            {{ $rating->user->name ?? 'Unknown User' }}
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{ $rating->book->title ?? 'Unknown Book' }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded-full font-semibold">
                                {{ $rating->rating }} / 5
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-6 text-gray-500">No ratings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $ratings->links('pagination::tailwind') }}
    </div>
@endsection
