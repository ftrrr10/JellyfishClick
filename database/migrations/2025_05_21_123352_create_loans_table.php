<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
    $table->id();
    $table->string('borrower_name');
    $table->unsignedBigInteger('book_id');
    $table->date('borrowed_at');
    $table->date('due_date');
    $table->timestamps();

    $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
