<?php

namespace App\Interfaces;

use App\Models\Category;

interface CategoryFetcherInterface
{
    public function getAllCategories();
    public function getAllProductsByCategory(Category $category);

}
