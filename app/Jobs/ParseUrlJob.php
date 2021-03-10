<?php

namespace App\Jobs;

use App\Jobs\Traits\ParsePosts\ParsePosts;
use App\Models\Post\Post;
use App\Models\Tag\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ParseUrlJob implements ShouldQueue
{
    use ParsePosts, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url;

    /**
     * Create a new job instance.
     *
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!in_array($frequency = config('parser.schedule'), config('parser.accepted')))
            die;
        $response = self::getHtml($this->url);
        $_posts = self::collectPosts($response);
        foreach ($_posts as $value) {
            $post = Post::firstOrCreate($value);

            // чтобы не проверять по телу поста
            $post_detail = self::getHtml($value['url']);
            $value['body'] = self::collectBody($post_detail);
            $value['tags'] = self::collectTags($post_detail);
            $post->body = $value['body'];

            $ids = function ($value) {
                return @Tag::firstOrCreate($value)->id;
            };
            $tags = array_map($ids, $value['tags']);
            $post->tags()->sync($tags);
            $post->save();
        }
    }
}
