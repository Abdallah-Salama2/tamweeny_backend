<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryFetcherInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    protected $categoryFetcherApi;

    public function __construct(CategoryFetcherInterface $categoryFetcher)
    {
        $this->categoryFetcherApi = $categoryFetcher;
        // CategoryFetcherWeb Not used cuz no need
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = CategoryResource::collection($this->categoryFetcherApi->getAllCategories());
        return Inertia::render('Admin/Categories/Index', [
            'categories' => $categories,
        ]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Category $category)
    {
        //
        $products=$this->categoryFetcherApi->getAllProductsByCategory($category);
        $products->load('productpricing', 'category');
        return Inertia::render('Admin/Categories/Show', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
