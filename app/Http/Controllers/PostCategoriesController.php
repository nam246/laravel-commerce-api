<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCategories\StorePostCategoriesRequest;
use Illuminate\Http\Request;
use App\Models\PostCategories;

class PostCategoriesController extends Controller
{
    public function index(Request $request)
    {
        $query = PostCategories::query();

        $perPage = $request->input('per_page', 10);
        $postCategories = $query->paginate($perPage);

        return response()->json([
            'data' => $postCategories->items(),
            'meta' => [
                'current_page' => $postCategories->currentPage(),
                'last_page' => $postCategories->lastPage(),
                'per_page' => $postCategories->perPage(),
                'total' => $postCategories->total()
            ]
        ], 200);
    }

    public function store(StorePostCategoriesRequest $request)
    {
        $data = $request->validated();

        $newPostCategories = PostCategories::create($data);

        return response()->json($newPostCategories, 201);
    }
}
