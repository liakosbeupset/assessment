<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

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
        //todo: check response in tinkerwell and write the function
    }

}
