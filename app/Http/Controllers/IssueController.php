<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issues = Issue::all();
        if (empty($issues)) {
            return redirect('/messagepage')->with('error', 'No book issue requests');
        } 
        // return $books;
        return view('backend/approveList', ['issues' => $issues]);
    }

    public function approvelist()
    {

        
        $issues = Issue::where('approval', '=', 0)->get();
        if (empty($issues)) {
            return redirect('/messagepage')->with('error', 'No book issued');
        } 
        return view('backend/issueList', ['issues' => $issues]);
    }

    public function issuelist()
    {
        $issues = Issue::where('approval', '=', 1)->get();
        if (empty($issues)) {
            return redirect('/messagepage')->with('error', 'No book issued');
        } 
        // return $issues;
        return view('backend/issueList', ['issues' => $issues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $issue = new Issue();
        $issue->book_id = $id;
        $issue->user_id = Auth::user()->id;
        $issue->date_of_return = null;
        $issue->save();

        return redirect('/')->with('success', 'Book issue request sent successfully! Wait for admin approval.');
    }

    public function approve($id)
    {
        $issue = Issue::find($id);
        $book = Book::find($issue->book_id);
        
        // check if the book is available in quantity
        if($book->quantity!=0){
            $issue->approval = 1;
            $issue->date_of_return = Carbon::now()->addDays(7);
            $issue->save();
        }
        
        return redirect('/approvelist')->with('success', 'Book issue request approved.');
    }







    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        //
    }
}
