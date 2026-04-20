<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'bank_id', 'total_price'];

    public function details() {
        return $this->hasMany(OrderDetail::class);
    }
}
