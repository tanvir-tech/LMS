<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booktoken;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

use Session;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::paginate(12);
        if (empty($books)) {
            return redirect('/messagepage')->with('error', 'No books');
        } 
        // return $books;
        return view('frontend/home', ['books' => $books]);
    }

    public function latestBooks()
    {
        $books = Book::orderBy('year', 'DESC')->get();
        if (empty($books)) {
            return redirect('/messagepage')->with('error', 'No books');
        }
        // return $books;
        return view('frontend/yearfilter', ['books' => $books]);
    }

    public function yearfilter(Request $req)
    {
        $books = Book::whereBetween('year', [$req->input('early'), $req->input('late')])
                        ->get()->last()->paginate(12);

        if (empty($books)) {
            // Session::flash('error', 'No books'); 
            return view('frontend/yearfilter', ['books' => $books]);
        }
        // return $books;
        return view('frontend/yearfilter', ['books' => $books]);
    }


    public function detail($id)
    {
        $book = Book::find($id);

        // find booktokens
        $booktokens = Booktoken::where('book_id', '=',$book->id)
                                ->where('isavailable', '=', 1)
                                ->get();
        
        // return view('frontend/detail', ['book' => $book]);
        // return $booktokens;
        return view('frontend/detail', compact('book', 'booktokens'));
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
            'category_id' => 'required',
            'edition' => 'required',
            'language' => 'required',
            'quantity' => 'required',
            // 'callid' => 'required',
            'bookcover' => 'required|file|mimes:jpg,jpeg,bmp,png'
        ]);

        // file
        $bookImageExt = $req->bookcover->extension();
        $new_bookImageName = time() . '_' . $req->bookname . '_' . $req->authorname . '.' . $bookImageExt;
        $req->bookcover->move(public_path('gallery'), $new_bookImageName);


        // generate call id
        $category = Category::find($req->category_id);
        $callidprefix = substr($req->bookname,0,3).substr($req->authorname,0,3)
                        .substr($req->publisher,0,3).substr($req->edition,0,3)
                        .substr($category->name,0,4);


        $book = new Book();
        $book->bookname = $req->bookname;
        $book->authorname = $req->authorname;
        $book->publisher = $req->publisher;
        $book->year = $req->year;
        $book->category_id = $req->category_id;
        $book->edition = $req->edition;
        $book->language = $req->language;
        $book->quantity = $req->quantity;
        $book->callid = $callidprefix.($req->callid);
        $book->bookcoverlink = $new_bookImageName;
        $book->save();

        
        for ($copy_id = 1; $copy_id <= $book->quantity; $copy_id+=1) {
            // create book tokens by quantity
            $booktoken = new Booktoken();
            $booktoken->book_id = $book->id;
            $booktoken->book_call_id = $book->callid;
            // generate copyid
            $booktoken->book_copy_id = $book->callid.$copy_id;
            $booktoken->save();
        };
        

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

        $categories = Category::all();
        // show the edit form and pass the shark
        return View::make('backend/editBook', ['categories' => $categories])->with('book', $book);
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
            'category_id' => 'required',
            'edition' => 'required',
            'language' => 'required',
            'quantity' => 'required',
            // 'callid' => 'required',
            // 'bookcover' => 'required|file|mimes:jpg,jpeg,bmp,png'
        ]);
        // return 'updating';




        // generate call id
        $category = Category::find($req->category_id);
        $callidprefix = substr($req->bookname,0,3).substr($req->authorname,0,3)
                        .substr($req->publisher,0,3).substr($req->edition,0,3)
                        .substr($category->name,0,4);


        $book = Book::find($id);


        $book->bookname = $req->bookname;
        $book->authorname = $req->authorname;
        $book->publisher = $req->publisher;
        $book->year = $req->year;
        $book->category_id = $req->category_id;
        $book->edition = $req->edition;
        $book->language = $req->language;
        $book->quantity = $req->quantity;
        $book->callid = $callidprefix.($req->callid);
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
            ->get();

        return view('frontend/home', ['books' => $books]);
    }



    function category($id)
    {
        $books = Book::where('category_id', '=',$id)->get();

        $subcategories = Category::where('parent_id', '=',$id)->get();

        foreach($subcategories as $subcategory){
            $subbooks = Book::where('category_id', '=',$subcategory->id)->get();
            $books = $books->merge($subbooks)->last()->paginate(12);
        }

        
        
        return view('frontend/home', ['books' => $books]);

    }
}
