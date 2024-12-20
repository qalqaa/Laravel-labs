<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SaveClick;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatMail;

class SendStatCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-stat-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $article_count = SaveClick::count();
        SaveClick::whereNotNull('id')->delete();
        $comment_count = Comment::whereDate('created_at', Carbon::today())->count();
        Mail::to('moosbeere_O@mail.ru')->send(new StatMail($article_count, $comment_count));

    }
}
