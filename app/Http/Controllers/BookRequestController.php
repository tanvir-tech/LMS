<?php

namespace App\Http\Controllers;

use App\Models\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookRequestController extends Controller
{
    public function userrequest(Request $req)
    {

        $req->validate([
            'bookname' => 'required',
            'authorname' => 'required'
        ]);

        $bookrequest = new BookRequest();
        $bookrequest->user_id = Auth::user()->id;
        $bookrequest->bookname = $req->bookname;
        $bookrequest->authorname = $req->authorname;
        $bookrequest->publisher = $req->publisher;
        $bookrequest->year = $req->year;
        $bookrequest->edition = $req->edition;
        $bookrequest->language = $req->language;
        $bookrequest->save();

        return redirect('/userrequest')->with('success', 'Book requested successfully!');
    }


    public function bookrequestlist()
    {
        $bookrequests = BookRequest::all();
        if (empty($bookrequests->last())) {
            return redirect('/messagepage')->with('error', 'No book requests');
        } else {
            $bookrequests->last()->paginate(18);
        }
        // return $bookrequests;
        return view('backend/requestlist', ['bookrequests' => $bookrequests]);
    }


}
