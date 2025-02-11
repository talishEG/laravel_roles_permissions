<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\ResponseService;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Controller;


class ProductsController extends Controller
{
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
        $products = Product::with(['images' => function($query) {
            $query->where('primary', 1);
        }])->latest()->paginate(10);
        return $this->responseService->sendResponse($products, []);
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
        $product = Product::with(['images' => function($query) {
            $query->where('primary', 1);
        }])->find($id);
        return $this->responseService->sendResponse($product, []);
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
