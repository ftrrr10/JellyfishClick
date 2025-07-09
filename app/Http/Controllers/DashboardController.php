<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Rating;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // Bagian ini sudah bagus, tidak ada perubahan
        $totalBooks = Book::count();
        $totalUsers = User::count();
        $totalRatings = Rating::count();
        $totalCategories = Category::count();

        // PENDEKATAN YANG LEBIH BAIK UNTUK TOP BOOKS
        // Menghitung rata-rata rating secara dinamis dari relasi
        $topBooks = Book::with('category')    // Mengambil data kategori terkait
            ->withAvg('ratings', 'rating')    // Membuat kolom virtual 'ratings_avg_rating'
            ->orderByDesc('ratings_avg_rating') // Mengurutkan berdasarkan kolom virtual tsb
            ->take(5)                         // Mengambil 5 buku teratas
            ->get();

        // Mengirim semua data ke view Anda ("dashboard.index")
        return view("dashboard.index", compact(
            'totalBooks', 
            'totalUsers', 
            'totalRatings', 
            'totalCategories', 
            'topBooks'
        ));
    }
}