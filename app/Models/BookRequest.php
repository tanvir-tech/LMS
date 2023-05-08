<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bookname',
        'authorname',
        'publisher',
        'year',
        'edition',
        'year',
        'language',
    ];  
}
