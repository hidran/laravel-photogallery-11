<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    protected $rules = [
        'category_name' => 'required',

    ];

    protected $messages = [
        'category_name.required' => 'Field name is required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // $categories =auth()->user()->categories()->paginate(10);

        $categories = Category::getCategoriesByUserId(auth()->user())->paginate(10);
        $category = new Category();
        return view('categories.index', compact('categories', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);
        $res = Category::create([
            'category_name' => $request->category_name,
            'user_id' => auth()->id()
        ]);

        $message = $res ? 'Category created' : 'Problem creating category';
        session()->flash('message', $message);
        if ($request->expectsJson()) {
            return [
                'message' => $message,
                'success' => $res
            ];
        }
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $category = new Category();
        return view('categories.create')->withCategory($category);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('categories.create')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, $this->rules, $this->messages);
        $category->category_name = $request->category_name;
        $res = $category->save();
        $message = $res ? 'Category deleted' : 'Problem deleting category';
        session()->flash('message', $message);
        if ($request->expectsJson()) {
            return [
                'message' => $message,
                'success' => $res
            ];
        }
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     */
    public function destroy(Category $category, Request $request)
    {
        $res = $category->delete();
        $message = $res ? 'Category deleted' : 'Problem deleting category';
        session()->flash('message', $message);
        if ($request->expectsJson()) {
            return [
                'message' => $message,
                'success' => (int)$res
            ];
        }
        return redirect()->route('categories.index');
    }
}
