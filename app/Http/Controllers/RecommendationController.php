<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Rating;

class RecommendationController extends Controller
{
    public function index(Request $request)
    {
    $books = collect();

    if ($request->filled('book')) {
        $book = Book::where('title', 'like', '%' . $request->book . '%')->first();

        if ($book) {
            // Ambil semua user yang kasih rating tinggi ke buku ini
            $similarUsers = Rating::where('book_id', $book->id)
                ->where('rating', '>=', 4)
                ->pluck('user_id');

            // Ambil buku lain yang mereka rating tinggi, bukan buku yang dimasukkan
            $recommendedBooks = Rating::whereIn('user_id', $similarUsers)
                ->where('book_id', '!=', $book->id)
                ->groupBy('book_id')
                ->selectRaw('book_id, AVG(rating) as avg_rating, COUNT(*) as user_count')
                ->having('avg_rating', '>=', 3.5)
                ->orderByDesc('avg_rating')
                ->orderByDesc('user_count')
                ->take(10)
                ->pluck('book_id');

            $books = Book::whereIn('id', $recommendedBooks)->get();
        }
    }

    return view('recommendations.index', compact('books'));
    }   

}
