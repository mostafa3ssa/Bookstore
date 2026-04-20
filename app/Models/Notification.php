<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'type', 'text', 'is_read', 'date'];
    
    public $timestamps = true;
}
