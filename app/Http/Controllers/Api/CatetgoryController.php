<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CatetgoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories=Category::all();
        // $users=User::paginate(10);

        return response()->json(CategoryResource::collection($categories));
    }
//    public function test()
//    {
//        //
//        $categories=Category::all();
//        $users = UserResource::collection(User::paginate(10)); // Adjust the number based on your requirements
//        // $users=User::paginate(10);
//        foreach ($categories as $category) {
//            $category->category_image = base64_encode($category->category_image);
//        }
//        return view('test2', compact('categories'));
//    }
//    public function test2()
//    {
//        //
//        $categories=Category::find(17);
//        dd($categories);
//
//        return response()->json($categories);
//    }

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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
