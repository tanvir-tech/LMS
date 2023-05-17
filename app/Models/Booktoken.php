<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Issue;

class Booktoken extends Model
{
    use HasFactory;

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}
