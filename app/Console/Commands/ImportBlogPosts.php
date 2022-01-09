<?php

namespace App\Console\Commands;

use App\Services\BlogService;
use App\Services\XBlog;
use Illuminate\Console\Command;

class ImportBlogPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import blog posts from 3rd part blogging platform';

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
     * @return int
     */
    public function handle()
    {
        BlogService::importNewPosts(app(XBlog::class));
    }
}
