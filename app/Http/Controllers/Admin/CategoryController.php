<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return response()->view('admin.categories.index', [
            'categories' => Category::query()
                ->when(
                    $request->input('search'),
                    fn ($q, $i) =>
                    $q->where(fn ($q) =>
                    $q->where("title", "LIKE", "%$i%")
                        ->orWhere("subtitle", "LIKE", "%$i%"))
                )
                ->withCount('posts')
                ->paginate(),
            'search' => $request->input('search')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::query()->create($request->validated());
        return Redirect::route('admin.categories.show', ['category' => $category->id])
            ->with('success', 'Category has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->fill($request->validated());
        $category->save();
        return Redirect::route('admin.categories.show', ['category' => $category->id])
            ->with('success', 'Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return Redirect::route('admin.categories.index')
            ->with('success', 'Category has been deleted!');
    }
}
