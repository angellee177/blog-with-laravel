<?php

namespace App\Console\Commands;

use App\Admin;
use App\Article;
use App\Notifications\UnreadArticlesNeedApproved;
use Illuminate\Console\Command;

class SendAdminUnreadArticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:newUserPost';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Admin email to Approved article';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $admin = Admin::all();

        $admin->map(function($admin){
            $articles = GetThreadArticles::new($admin);

            $admin->notify (new UnreadArticlesInThread($articles, $admin));
        });
    }
}
