<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PostsService {

    //Function to fetch posts from public api
    public function fetch(): array {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        if(!$response->successful()) {
            throw new \Exception('Error fetching posts with status: '. $response->status());
        }
        return $response->json();
    }

    //Function to store posts to our database with the correct structure
    public function store(array $posts): void {
        foreach ($posts as $post) {
            Post::updateOrCreate([
                'api_id' => $post['id'],
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'body' => $post['body']
            ]);
        }
    }

}
