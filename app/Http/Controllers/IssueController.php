<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Book;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Notifications\ReturnReminder;
use Illuminate\Support\Facades\Notification;

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
        return view('backend/approveList', ['issues' => $issues]);
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
        
        // check-quantity
        if($book->quantity!=0){
            $issue->approval = 1;
            $issue->date_of_return = Carbon::now()->addDays(7)->toDateTimeString();
            //decrease book quantity
            $book->quantity = $book->quantity-1;
            $book->save();
            $issue->save();
        }
        
        return redirect('/admin/approvelist')->with('success', 'Book issue request approved.');
    }

    public function deny($id)
    {
        $issue = Issue::find($id);
        $issue->delete();
        
        return redirect('/admin/approvelist')->with('error', 'Book issue request deleted.');
    }

    public function renew($id)
    {
        $issue = Issue::find($id);
        $issue->approval = 1;
        $issue->date_of_return = Carbon::now()->addDays(7);
        $issue->save();

        return redirect('/admin/issuelist')->with('warning', 'Book issue renewed.');
    }

    public function receive($id)
    {
        $issue = Issue::find($id);
        $book = Book::find($issue->book_id);
        //increase book quantity
        $book->quantity = $book->quantity+1;
        $book->save();
        $issue->delete();
        
        return redirect('/admin/issuelist')->with('success', 'Book issue request deleted.');
    }

    public function remindUser($user_id)
    {
        $user = User::find($user_id);
        // search users issues 
        $issues = Issue::where('user_id', '=', $user_id)->get();
        if (empty($issues)) {
            return true;
        } 
        return view('backend/issueList', ['issues' => $issues]);
    }


    public function remind($issue_id)
    {
        $issue = Issue::find($issue_id);
        // search users issues 
        $user = $issue->user;
        $book = $issue->book;

        $today = Carbon::now();

        $late = $today->diff($issue['date_of_return'])->format('%R%a days');
        $lateint = intval($today->diff($issue['date_of_return'])->format('%a'));

        if (str_contains($late, '+') || $lateint<7) {
            $lateint = 0;
            return redirect('/admin/issuelist')->with('error', 'The selected user has no fine.');
        } else{
            Notification::send($user, new ReturnReminder($user->name,$book->bookname,$lateint));
            return redirect('/admin/issuelist')->with('success', 'Reminder email sent.');
        }


        // mail user to return the specific book 
        // $user->notify(new ReturnReminder($user->name,$book->bookname,$lateint))->delay(Carbon::now()->addSeconds(2));
        
    }

    public function remindAll()
    {
        $today = Carbon::now();
                // ->subDay(7);
        // find fineable issues
        $issues = Issue::where('date_of_return','<',$today)->get();
        // loop-call remind function with issue id
        foreach($issues as $issue){
            $issue = Issue::find($issue->id);
            $user = $issue->user;
            $book = $issue->book;

            $late = $today->diff($issue['date_of_return'])->format('%R%a days');
            $lateint = intval($today->diff($issue['date_of_return'])->format('%a'));

            if (str_contains($late, '+') || $lateint<7) {
                $lateint = 0;
            } else {
                Notification::send($user, new ReturnReminder($user->name,$book->bookname,$lateint));
            }





        }

        return redirect('/admin/issuelist')->with('success', 'Reminder email sent to all fined users.');


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
