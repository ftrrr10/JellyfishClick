<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;
use League\Csv\Reader;
use App\Models\Book;


class RatingsDatasetSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/public/ratings.csv');

        if (!file_exists($path)) {
            $this->command->error('File ratings.csv tidak ditemukan. Taruh di storage/app/public/');
            return;
        }

        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        $count = 0;

        foreach ($records as $record) {
    if ($count >= 100000) break;

    // hanya proses jika book_id valid
    if (!\App\Models\Book::where('id', $record['book_id'])->exists()) continue;

    Rating::create([
        'user_id' => $record['user_id'],
        'book_id' => $record['book_id'],
        'rating' => $record['rating'],
    ]);

    $count++;
}

        

        $this->command->info("Imported $count ratings from ratings.csv");
    }
}
