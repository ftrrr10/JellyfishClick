<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksDatasetSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/public/books.csv');

        if (!file_exists($path)) {
            $this->command->error('File books.csv tidak ditemukan. Taruh file-nya di storage/app/public/');
            return;
        }

        if (($handle = fopen($path, 'r')) === false) {
            $this->command->error('Tidak bisa membuka file books.csv');
            return;
        }

        $header = fgetcsv($handle); // Baca header dulu
        $count = 0;

        while (($data = fgetcsv($handle)) !== false) {
            $record = array_combine($header, $data);

            Book::create([
                'title' => $record['title'],
                'authors' => $record['authors'],
                'goodreads_book_id' => $record['goodreads_book_id'], 
                'publication_year' => is_numeric($record['original_publication_year']) ? (int) $record['original_publication_year'] : null,
                'isbn' => $record['isbn'] ?: null,
                'isbn13' => strval($record['isbn13']) ?: null,
                'language_code' => $record['language_code'] ?: null,
                'publisher' => $record['publisher'] ?? null,
                'ratings_count' => is_numeric($record['ratings_count']) ? (int) $record['ratings_count'] : null,
                'average_rating' => is_numeric($record['average_rating']) ? (float) $record['average_rating'] : null,
                'image_url' => $record['image_url'] ?: null,
                'category_id' => null
            ]);

            $count++;
        }

        

        fclose($handle);

        $this->command->info("Imported $count books from books.csv");
    }
}
