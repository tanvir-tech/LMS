<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Book;
use App\Models\Booktoken;
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
        $issues = Issue::where('isactive', '=', 1)
                        ->orderBy('id', 'DESC')
                        ->get();

        if (empty($issues)) {
            return redirect('/messagepage')->with('error', 'No book issue requests');
        } 
        // return $issues[0]->booktoken;
        return view('backend/allissueslist', ['issues' => $issues]);
    }


    function searchissue(Request $req)
    {
        $issues = Issue::where('user_id', '=', $req->input('query'))
                        ->where('isactive', '=', 1)
                        ->get();
        return view('backend/allissueslist', ['issues' => $issues]);
    }


    public function borrowlist(Request $request)
    {
        $user_id = Auth::user()->id;
        $issues = Issue::where('user_id', '=', $user_id)
                        ->where('isactive', '=', 1)
                        ->get();
        if (empty($issues)) {
            return redirect('/messagepage')->with('error', 'No book issue requests');
        } 
        // return $issues;
        return view('frontend/issuelist', ['issues' => $issues]);
    }


    public function approvelist()
    {
        $issues = Issue::where('approval', '=', 0)
                        ->where('isactive', '=', 1)
                        ->get();
        if (empty($issues)) {
            return redirect('/messagepage')->with('error', 'No book issued');
        } 
        return view('backend/approveList', ['issues' => $issues]);
    }

    public function issuelist()
    {
        $issues = Issue::where('approval', '=', 1)
                        ->where('isactive', '=', 1)
                        ->get();
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
    public function create(Request $req)
    {
        $book_id = $req->book_id;
        $booktoken_id = $req->booktoken_id;


        // check if the user is illigible to get a book
        $user_id = Auth::user()->id;
        $issueCount = Issue::where('user_id', '=', $user_id)
                            // ->where('approval','=',1)
                            ->get()
                            ->count();
        
        $book = Book::find($book_id);
        $booktoken = Booktoken::find($booktoken_id);

        if($book->quantity>1){

            // student <4 ______and______teacher no limit

            if(Auth::user()->isteacher==0 && $issueCount>3){
                // return $issueCount;
                return redirect('/')->with('error', 'You are not illigible for new book issue.Return any book or cancel any borrow request and try again.');
            };


            $issue = new Issue();
            $issue->book_id = $book_id;
            $issue->user_id = $user_id;
            $issue->date_of_return = null;
            $issue->ismailed = false;
            $issue->booktoken_id = $booktoken->id;
            $booktoken->isavailable = 0;
            
            $booktoken->save();
            $issue->save();

            $booktoken->issue_id = $issue->id;
            $booktoken->save();

            return redirect('/')->with('success', 'Book issue request sent successfully! Wait for admin approval.');
        };

        
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
        $booktoken = Booktoken::find($issue->booktoken_id);

        $booktoken->isavailable=1;
        $booktoken->issue_id=null;
        $issue->isactive = 0;

        $issue->save();
        $booktoken->save();
        
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
        
        $booktoken = Booktoken::find($issue->booktoken_id);

        $booktoken->isavailable=1;
        $booktoken->issue_id=null;
        $issue->isactive = 0;

        $issue->save();
        $booktoken->save();
        
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

        if (str_contains($late, '+')) {
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
        $issues = Issue::where('date_of_return','<',$today)
                        ->where('isactive', '=', 1)
                        ->get();
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


    public function delete($id)
    {
        $issue = Issue::find($id);
        $booktoken = Booktoken::find($issue->booktoken_id);

        $booktoken->isavailable=1;
        $booktoken->issue_id=null;
        $issue->isactive = 0;

        $issue->save();
        $booktoken->save();
        
        return redirect('/borrowlist')->with('error', 'Book issue request deleted.');
    }


}
