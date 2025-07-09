@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Form Peminjam</h1>

<form action="{{ route('loans.preview') }}" method="POST" class="space-y-4">

    @csrf
    <div>
        <label>Nama Peminjam</label>
        <input type="text" name="borrower_name" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label>Buku</label>
        <select name="book_id" class="w-full border p-2 rounded">
            @foreach($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Tanggal Pinjam</label>
        <input type="date" name="borrowed_at" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label>Tanggal Kembali</label>
        <input type="date" name="due_date" class="w-full border p-2 rounded" required>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
</form>
@endsection
