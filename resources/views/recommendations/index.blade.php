@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">📚 Rekomendasi Buku Berdasarkan Judul</h1>

    <!-- Form input judul buku -->
    <form method="GET" action="{{ route('recommendations.index') }}" class="mb-6">
        <div class="flex items-center gap-x-4">
            <select name="book" id="book-select" class="w-72" style="width: 100%">
                <option value="{{ request('book') }}">{{ request('book') }}</option>
            </select>
        
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded ml-2 hover:bg-blue-700">
                Cari Rekomendasi
            </button>
        </div>    
    </form>


    <!-- Hasil rekomendasi -->
    @if(request()->filled('book'))
        @if ($books->isEmpty())
            <p class="text-gray-500">Maaf, tidak ditemukan rekomendasi berdasarkan buku <strong>{{ request('book') }}</strong>.</p>
        @else
            <h2 class="text-xl font-semibold mb-4">✨ Rekomendasi berdasarkan: <span class="text-blue-700">"{{ request('book') }}"</span></h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($books as $book)
                    <div class="bg-white p-4 rounded-lg shadow hover:shadow-md transition-all">
                        <img src="{{ $book->image_url }}" alt="{{ $book->title }}" class="w-full h-40 object-cover rounded">
                        <h3 class="mt-2 text-lg font-semibold text-gray-800">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600 mb-2">by {{ $book->authors }}</p>

                        @if ($book->category)
                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded-full">
                                {{ $book->category->name }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    @else
        <p class="text-gray-500">Masukkan judul buku di atas untuk melihat rekomendasi yang relevan.</p>
    @endif
  
    @push('scripts')
    <script>
        $(document).ready(function () {
            $('#book-select').select2({
                placeholder: "Cari judul buku...",
                minimumInputLength: 2,
                ajax: {
                    url: '{{ route("books.search") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return { q: params.term };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(function (title) {
                                return { id: title, text: title };
                            })
                        };
                    }
                }
            });
        });
</script>
@endpush


@endsection
