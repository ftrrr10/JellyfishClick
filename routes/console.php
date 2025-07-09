<?php

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Str;

Artisan::command('books:assign-categories', function () {
    $tagToCategory = [
        'fantasy' => 'Fantasi',
        'science-fiction' => 'Sci-Fi',
        'fiction' => 'Fiksi',
        'classics' => 'Literatur Klasik',
        'travel' => 'Petualangan',
        'science' => 'Ilmiah',
        'poetry' => 'Puisi',
        'romance' => 'Romance',
        'mystery' => 'Misteri',
        'history' => 'Sejarah',
        'drama' => 'Drama'
    ];

    // Load top tag per book (assumes mapping loaded or created previously)
    $csvPath = storage_path('app/public/top_tags_per_book.csv');

    if (!file_exists($csvPath)) {
        $this->error("File top_tags_per_book.csv tidak ditemukan.");
        return;
    }

    $lines = array_map('str_getcsv', file($csvPath));
    $header = array_shift($lines);

    foreach ($lines as $row) {
        [$bookId, $tagName, $count] = $row;
        $tagName = trim(Str::lower($tagName));

        if (!isset($tagToCategory[$tagName])) continue;

        $categoryName = $tagToCategory[$tagName];
        $category = Category::firstOrCreate(['name' => $categoryName]);

        $book = Book::where('goodreads_book_id', $bookId)->first();
        if ($book) {
            $book->category_id = $category->id;
            $book->save();
        }
    }

    $this->info('Kategori berhasil di-assign ke buku berdasarkan tag terpopuler!');
});
