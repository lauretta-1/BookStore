<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable=['title', 'description', 'cover_image', 'author', 'price'];

    public function bookAuthor()
    {
        return $this->belongsTo(User::class, 'author');
    }
}
