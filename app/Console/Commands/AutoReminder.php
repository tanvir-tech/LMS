<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Issue;
use App\Models\Book;
use App\Models\User;

use Carbon\Carbon;
use App\Notifications\ReturnReminder;
use Illuminate\Support\Facades\Notification;

class AutoReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autoreminder:checkfine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will remind by mail to return book after checking who have delayed.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;


        $today = Carbon::now();
        
        // find fineable issues
        $issues = Issue::where('date_of_return','<',$today)->get();
        // loop-call remind function with issue id
        foreach($issues as $issue){
            $issue = Issue::find($issue->id);
            $user = $issue->user;
            $book = $issue->book;

            $late = $today->diff($issue['date_of_return'])->format('%R%a days');
            $lateint = intval($today->diff($issue['date_of_return'])->format('%a'));

            if (str_contains($late, '+')) {
                $lateint = 0;
            } else {
                Notification::send($user, new ReturnReminder($user->name,$book->bookname,$lateint));
            }

        }


    }
}
