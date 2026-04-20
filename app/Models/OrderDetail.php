<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id', 'book_id', 'user_id', 'bank_id'];

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
