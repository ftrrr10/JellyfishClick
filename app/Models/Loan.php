<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    public function book()
    {
    return $this->belongsTo(Book::class);
    }

    protected $fillable = [
        'borrower_name',
        'book_id',
        'borrowed_at',
        'due_date',
    ];


}
