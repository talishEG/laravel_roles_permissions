<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view categories' , only: ['index']),
            new Middleware('permission:edit categories' , only: ['edit']),
            new Middleware('permission:create categories' , only: ['create']),
            new Middleware('permission:delete categories' , only: ['delete']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|min:3',
        ]);
        if($validator->passes()) {
            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);
            return redirect()->route('categories.index')->with('success', 'Article created successfully');
        } else {
            return back()->withErrors($validator)->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('categories.create', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,'.$id.',id|min:3',
        ]);
        $category = Category::find($id);
        if($validator->passes()) {
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->save();
            return redirect()->route('categories.index')->with('success', 'Category Updated successfully');
        } else {
            return back()->withErrors($validator)->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
