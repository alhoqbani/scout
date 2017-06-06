<?php

namespace App\Observers;

use App\Post;
use Elasticsearch\ClientBuilder;

class PostObserver
{
    
    /**
     * Listen to the User created event.
     *
     * @param \App\Post $post
     *
     * @return void
     * @internal param \App\Post $post
     */
    public function created(Post $post)
    {
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'posts',
            'type'  => 'post_type',
            'id'    => $post->id,
            'body'  => $post->toArray(),
        ];
        $client->index($params);
    }
    
    public function updated(Post $post)
    {
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'posts',
            'type'  => 'post_type',
            'id'    => $post->id,
            'body'  => [
                'doc' => $post->toArray(),
            ]
        ];
        $client->update($params);
    }
    
    /**
     * Listen to the User deleting event.
     *
     * @param  Post $post
     *
     * @return void
     */
    public function deleting(Post $post)
    {
        //
    }
}
