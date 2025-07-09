@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Create New User</h1>

    {{-- Bagian ini sudah bagus, tidak perlu diubah --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- PERUBAHAN 1: Sesuaikan route ke rute admin --}}
    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6 bg-white shadow-xl rounded-xl p-8">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            {{-- Menambahkan 'old()' untuk menyimpan input jika validasi gagal --}}
            <input type="text" name="name" id="name" class="mt-1 w-full border border-gray-300 rounded px-3 py-2" value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 w-full border border-gray-300 rounded px-3 py-2" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-1 w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        {{-- PERUBAHAN 2: Tambahkan field untuk Role --}}
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" id="role" class="mt-1 w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="flex items-center justify-between pt-4">
             {{-- PERUBAHAN 1 (Lanjutan): Sesuaikan route ke rute admin --}}
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline">Back to User List</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save User</button>
        </div>
    </form>
@endsection