<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id', 'title', 'genre', 'price', 'isbn', 'description'
    ];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function reviews() {
        return $this->hasMany(BookReview::class);
    }
}
