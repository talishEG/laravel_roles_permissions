<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:view articles' , only: ['index']),
            new Middleware('permission:edit articles' , only: ['edit']),
            new Middleware('permission:create articles' , only: ['create']),
            new Middleware('permission:delete articles' , only: ['delete']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $articles = Article::latest()->paginate(5);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5',
            'text' => 'required|min:10',
            'author' => 'required|min:5',
        ]);
        if($validator->passes()) {
            Article::create([
                'title' => $request->title,
                'text' => $request->text,
                'author' => $request->author
            ]);
            return redirect()->route('articles.index')->with('success', 'Article created successfully');
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
        $article = Article::find($id);
        return view('articles.create', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5',
            'author' => 'required|min:5',
        ]);
        $article = Article::find($id);
        if($validator->passes()) {
            $article->title = $request->title;
            $article->text = $request->text;
            $article->author = $request->author;
            $article->save();
            return redirect()->route('articles.index')->with('success', 'Article created successfully');
        } else {
            return back()->withErrors($validator)->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);
        if ($article == null) {
            return redirect()->route('articles.index')->with('error', 'Article not found');
        }
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully');
    }
}
