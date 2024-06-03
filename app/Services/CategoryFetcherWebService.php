<?php

namespace App\Services;

use App\Interfaces\CategoryFetcherInterface;
use App\Models\Category;

class CategoryFetcherWebService implements CategoryFetcherInterface
{

    public function getAllCategories()
    {
        // TODO: Implement getAllCategories() method.
        return[];
    }

    public function getAllProductsByCategory(Category $category)
    {
        // TODO: Implement getAllProductsByCategory() method.
    }
}
