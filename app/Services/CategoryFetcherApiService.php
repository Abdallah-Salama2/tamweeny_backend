<?php

namespace App\Services;

use App\Interfaces\CategoryFetcherInterface;
use App\Models\Category;
use App\Models\Product;

class CategoryFetcherApiService implements CategoryFetcherInterface
{

    public function getAllCategories()
    {
        // TODO: Implement getAllCategories() method.
        return Category::all();

    }

    public function getAllProductsByCategory(Category $category)
    {
        // TODO: Implement getAllProductsByCategory() method.
        $category = Category::where('category_name', $category->category_name)->firstOrFail();
        $products = Product::where('cat_id', $category->id)->get();
        return $products;
    }
}
