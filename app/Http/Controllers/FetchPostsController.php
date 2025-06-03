<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchPostsController extends Controller
{
    public function fetch(Request $request): JsonResponse {
        try {
            $query = Post::query();

            //add chained where statements for search if it exists in parameters for each of the fields we need
            if ($request->has('search')) {
                $sq = $request->query('search');
                $query->where(function ($q) use ($sq) {
                    $q->where('title', 'like', '%'.$sq.'%')->orWhere('body', 'like', '%'.$sq.'%');
                });
            }

            $items = $query->get();

            return response()->json([
                'message' => 'Posts fetched successfully.',
                'data' => PostResource::collection($items),
            ]);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
