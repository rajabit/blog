<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCategoryRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->input('not-related', 0) == 1)
            return response()->json(Category::query()
                ->whereDoesntHave('posts', fn ($q) => $q->where('post_id', $request->input('post_id')))
                ->latest()
                ->paginate());

        return response()->json(Post::query()
            ->findOrFail($request->input('post_id'))->categories()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCategoryRequest $request)
    {
        return response()->json(Post::query()->findOrFail($request->input('post_id'))->categories()->attach($request->input('category_id')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        return response()->json(Post::query()->findOrFail($request->input('post_id'))->categories()->detach($id));
    }
}
