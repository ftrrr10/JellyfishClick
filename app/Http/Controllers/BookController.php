<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Fungsi ini untuk user biasa (dan admin) melihat daftar buku
    public function index(Request $request)
    {
        $query = Book::with('category')->latest();

        if($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $books = $query->paginate(15);
        $categories = Category::all();

        // Menggunakan view 'books.index' yang sudah benar
        return view('books.index', compact('books', 'categories'));
    }

    // Fungsi ini untuk admin menampilkan form tambah buku
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    // Fungsi ini untuk admin menyimpan buku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'publication_year' => 'nullable|integer',
            'isbn' => 'nullable|string|max:20',
            'image_url' => 'nullable|url',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'category_id' => 'nullable|exists:categories,id', // Menambahkan validasi category_id
        ]);

        Book::create($validated);

        // [ PERBAIKAN DI SINI ] Mengarahkan ke rute admin.books.index
        return redirect()->route('admin.books.index')->with('success', 'Book added successfully.');
    }

    // Fungsi ini untuk admin menampilkan form edit buku
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    // Fungsi ini untuk admin memperbarui buku
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'publication_year' => 'nullable|integer',
            'isbn' => 'nullable|string|max:20',
            'image_url' => 'nullable|url',
            'average_rating' => 'nullable|numeric|min:0|max:5',
            'category_id' => 'nullable|exists:categories,id', // Menambahkan validasi category_id
        ]);

        $book->update($validated);

        // [ PERBAIKAN DI SINI ] Mengarahkan ke rute admin.books.index
        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    // Fungsi ini untuk admin menghapus buku
    public function destroy(Book $book)
    {
        $book->delete();
        
        // [ PERBAIKAN DI SINI ] Mengarahkan ke rute admin.books.index
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }

    // Fungsi untuk pencarian (autocomplete)
    public function search(Request $request)
    {
        $term = $request->get('q');
        $books = Book::where('title', 'like', '%' . $term . '%')
                    ->limit(10)
                    ->pluck('title');

        return response()->json($books);
    }
}
