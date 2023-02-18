<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        if (empty($books->last())) {
            return redirect('/messagepage')->with('error', 'No books');
        } else {
            $books->last()->paginate(6);
        }
        // return $books;
        return view('frontend/home', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        $req->validate([
            'bookname' => 'required',
            'authorname' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'category' => 'required',
            'edition' => 'required',
            'language' => 'required',
            'quantity' => 'required',
            'callid' => 'required',
            'bookcover' => 'required|file|mimes:jpg,jpeg,bmp,png'
        ]);

        // file
        $bookImageExt = $req->bookcover->extension();
        $new_bookImageName = time() . '_' . $req->bookname . '_' . $req->authorname . '.' . $bookImageExt;
        $req->bookcover->move(public_path('gallery'), $new_bookImageName);


        $book = new Book();
        $book->bookname = $req->bookname;
        $book->authorname = $req->authorname;
        $book->publisher = $req->publisher;
        $book->year = $req->year;
        $book->category = $req->category;
        $book->edition = $req->edition;
        $book->language = $req->language;
        $book->quantity = $req->quantity;
        $book->callid = $req->callid;
        $book->bookcoverlink = $new_bookImageName;
        $book->save();


        return redirect('/admin/createBook')->with('success', 'Book created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);

        // show the edit form and pass the shark
        return View::make('backend/editBook')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $req, $id)
    {
        $req->validate([
            'bookname' => 'required',
            'authorname' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'category' => 'required',
            'edition' => 'required',
            'language' => 'required',
            'quantity' => 'required',
            'callid' => 'required',
            // 'bookcover' => 'required|file|mimes:jpg,jpeg,bmp,png'
        ]);
        // return 'updating';
        $book = Book::find($id);


        $book->bookname = $req->bookname;
        $book->authorname = $req->authorname;
        $book->publisher = $req->publisher;
        $book->year = $req->year;
        $book->category = $req->category;
        $book->edition = $req->edition;
        $book->language = $req->language;
        $book->quantity = $req->quantity;
        $book->callid = $req->callid;
        // $book->bookcoverlink = $new_bookImageName;
        $book->save();
        



        // redirect
        return redirect('/')->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($book)
    {
        $book = Book::find($book);

        File::delete(public_path("gallery/" . $book->bookcoverlink));
        $book->delete();



        return redirect('/');
    }

    function search(Request $req)
    {

        $books = Book::where('bookname', 'like', '%' . $req->input('query') . '%')
            ->orWhere('authorname', 'like', '%' . $req->input('query') . '%')
            ->orWhere('publisher', 'like', '%' . $req->input('query') . '%')
            ->orWhere('year', 'like', '%' . $req->input('query') . '%')
            ->orWhere('category', 'like', '%' . $req->input('query') . '%')
            // ->orWhere('created_at', 'like', '%' . $req->input('query') . '%')
            ->get();

        return view('frontend/home', ['books' => $books]);
    }

    public function latestBooks()
    {
        $books = Book::orderBy('year', 'DESC')->paginate(6);
        // return $books;
        return view('frontend/home', ['books' => $books]);
    }
}
