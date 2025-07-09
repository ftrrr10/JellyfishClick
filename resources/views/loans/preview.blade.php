@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Preview Peminjaman</h1>

<div class="bg-white p-4 rounded shadow mb-4">
    <p><strong>Nama:</strong> {{ $data['borrower_name'] }}</p>
    <p><strong>Buku:</strong> {{ $book->title }}</p>
    <p><strong>Tanggal Pinjam:</strong> {{ $data['borrowed_at'] }}</p>
    <p><strong>Tanggal Kembali:</strong> {{ $data['due_date'] }}</p>
</div>

<form action="{{ route('loans.store') }}" method="POST" class="inline">
    @csrf
    @foreach ($data as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Konfirmasi & Simpan</button>
</form>

<form action="{{ route('loans.printPreview') }}" method="POST" class="inline ml-2" target="_blank">
    @csrf
    @foreach ($data as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Cetak PDF</button>
</form>

<a href="{{ route('loans.create') }}" class="inline-block ml-4 text-blue-600 hover:underline">Kembali Ubah</a>
@endsection
