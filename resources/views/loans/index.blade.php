@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Riwayat Peminjam</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tombol cetak ini hanya akan muncul jika ada data peminjaman --}}
    @if ($loans->isNotEmpty())
        <div class="mb-4">
            <a href="{{ route('loans.print') }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 inline-block">
                Cetak Riwayat PDF
            </a>
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full table-auto border-collapse">
            <thead class="bg-purple-200 text-purple-900">
                <tr>
                    <th class="border p-3 text-left">Nama</th>
                    <th class="border p-3 text-left">Judul Buku</th>
                    <th class="border p-3 text-left">Tanggal Pinjam</th>
                    <th class="border p-3 text-left">Tanggal Kembali</th>
                    <th class="border p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($loans as $loan)
                    <tr class="hover:bg-gray-50">
                        <td class="border p-3">{{ $loan->borrower_name }}</td>
                        <td class="border p-3">{{ $loan->book->title }}</td>
                        <td class="border p-3">{{ \Carbon\Carbon::parse($loan->borrowed_at)->format('d M Y') }}</td>
                        <td class="border p-3">{{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}</td>
                        <td class="border p-3 text-center">
                            <a href="{{ route('loans.receipt', $loan->id) }}" 
                                class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700" 
                                target="_blank">Cetak Struk</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4">Belum ada data peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection