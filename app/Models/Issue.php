<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Book;
use App\Models\Booktoken;
use App\Models\User;

class Issue extends Model
{
    use HasFactory;

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booktoken()
    {
        return $this->hasOne(Booktoken::class);
    }

    
}
