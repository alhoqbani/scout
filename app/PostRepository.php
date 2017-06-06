<?php

namespace App;

use Elasticsearch\ClientBuilder;

class PostRepository
{
    
    
    public static function search($query, $field)
    {
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'posts',
            'type'  => 'post_type',
            'body'  => [
                'query' => [
                    'match' => [
                        $field => $query,
                    ],
                ],
            ],
        ];
        
        return $client->search($params);
        
    }
    
    public static function searchBody($q)
    {
        $result =  (new static)->search($q, 'body');
        $attributes = array_first($result['hits']['hits'])['_source'];
        $post = new Post($attributes);
        $post->exists = true;
        $originalPost = Post::find($attributes['id']);
        dd($post, $originalPost);
    }
    
    
}