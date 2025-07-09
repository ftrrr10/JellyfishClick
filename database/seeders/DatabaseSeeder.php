<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    public function run(): void
{
    // Seed kategori dummy dulu (boleh kamu keep)
    $categories = [
        'Fiksi', 'Teknologi', 'Edukasi', 'Sejarah', 'Komik'
    ];

    foreach ($categories as $name) {
        Category::firstOrCreate(['name' => $name]);
    }

    // Import dari books.csv
    $this->call([
        BooksDatasetSeeder::class,
        RatingsDatasetSeeder::class, // boleh kamu komen dulu kalau belum siap
    ]);
    }

}
