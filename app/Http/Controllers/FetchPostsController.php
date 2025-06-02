<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchPostsController extends Controller
{
    public function fetch(): JsonResponse {
        try {
            $items = Post::all();
            return response()->json([
                'message' => 'Posts fetched successfully.',
                'data' => $items
            ]);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
