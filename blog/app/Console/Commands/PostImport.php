<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use App\Models\User;

class PostImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import posts for admin user';

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
        try{
            $response = Http::get('https://sq1-api-test.herokuapp.com/posts');
            $registers = $response->json();
            $user = User::where('name', 'admin')->first();

            foreach ($registers['data'] as $register) {
                if ( !Post::where('title', $register['title'])->where('published_date', $register['publication_date'])->first() ) {
                    $post = new Post();
                    $post->user_id = $user->id;
                    $post->title = $register['title'];
                    $post->description = $register['description'];
                    $post->published_date = $register['publication_date'];
                    $post->save();
                }
            }

            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage().' - '.$e->getLine());
        }
    }
}
