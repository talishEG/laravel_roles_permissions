<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\ResponseService;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Controllers\Controller;
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
     * @var ResponseService
     */
    protected ResponseService $responseService;

    /**
     * @param ResponseService $responseService
     */
    public function __construct(
        ResponseService $responseService
    ) {
        $this->responseService = $responseService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->paginate(1);
        return $this->responseService->sendResponse($articles, []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
