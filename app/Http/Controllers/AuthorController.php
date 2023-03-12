<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Book::select('authorname')->get();

        if (empty($authors->last())) {
            return redirect('/messagepage')->with('error', 'No authors');
        } else {
            $authors->last()->paginate(18);
        }
        // return $authors;
        return view('frontend/authors', ['authors' => $authors]);
    }

    public function authorbooks($authorname)
    {
        $books = Book::where('authorname', '=', $authorname)->get();

        if (empty($books->last())) {
            return redirect('/messagepage')->with('error', 'No authors');
        } else {
            $books->last()->paginate(18);
        }
        // return $books;
        return view('frontend/home', ['books' => $books]);
    }
}
