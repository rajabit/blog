<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('admin.posts.index', [
            'posts' => Post::query()
                ->when(
                    $request->input('search'),
                    fn ($q, $s) => $q->where(fn ($q) => $q
                        ->where('title', 'LIKE', "%$s%"))
                        ->orWhereRaw("MATCH(summary) AGAINST('$s' IN NATURAL LANGUAGE MODE)"),
                    fn ($q) => $q->latest()
                )
                ->select(
                    'id',
                    'user_id',
                    'title',
                    'slug',
                    'summary',
                    'views',
                    'published_at',
                    'created_at',
                    'updated_at',
                )
                ->with('user:id,name,picture')
                ->paginate(),
            'search' => $request->input('search')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $post = new Post();
        $post->user_id = auth()->id();
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->summary = $request->input('summary');
        $post->content = $request->input('content');
        $post->views = 0;
        $post->published_at = now();
        $post->save();

        return Redirect::route('admin.posts.show', ['post' => $post->id])
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
