<?php

namespace App\Http\Controllers;

use App\Services\PostsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImportPostsController extends Controller
{
    public function import(PostsService $service): JsonResponse {
        try {
            $posts = $service->fetch();
            $service->store($posts);
            return response()->json(['message' => 'Posts imported successfully.']);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
