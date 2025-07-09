<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('authors');
            $table->bigInteger('goodreads_book_id')->nullable()->unique();
            $table->integer('publication_year')->nullable();
            $table->string('isbn')->nullable();
            $table->string('isbn13')->nullable();
            $table->string('language_code')->nullable();
            $table->string('publisher')->nullable();
            $table->integer('ratings_count')->nullable();
            $table->float('average_rating', 3, 2)->nullable();
            $table->string('image_url')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
