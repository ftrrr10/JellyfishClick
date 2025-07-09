<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'authors',
        'goodreads_books_id',
        'publication_year',
        'isbn',
        'isbn13',
        'language_code',
        'publisher',
        'ratings_count',
        'average_rating',
        'image_url',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    

}
