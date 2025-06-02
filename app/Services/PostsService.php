<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
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
    public function store(array $posts): array {
        //initialize the variables to log the data fetched from api against the data saved to the database
        $savedPosts = 0;
        $skippedPosts = [];

        foreach ($posts as $post) {
            //validate title and body to make sure we have all the required fields. Also the title should be unique
            $validator = Validator::make($post, [
                'title' => 'required|string|max:255|unique:posts,title,' . $post['id'],
                'body' => 'required'
            ]);

            //log the failed data
            if ($validator->fails()) {
                $skippedPosts[] = [
                    'post' => $post,
                    'errors' => $validator->errors()->all(),
                ];
                continue;
            }

            //update or create the post in the database and generate slug from the title
            Post::updateOrCreate([
                'api_id' => $post['id'],
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'body' => $post['body']
            ]);

            //count the saved/updated posts in the database
            $savedPosts++;
        }
        return ['savedPosts' => $savedPosts, 'skippedPosts' => $skippedPosts];
    }

}
