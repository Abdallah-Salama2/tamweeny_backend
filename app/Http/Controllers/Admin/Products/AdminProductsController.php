<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\trait\GeneralTrait;
use App\Interfaces\Product\ProductFetcherInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPricing;
use App\Services\FileStorage\Interfaces\FileStorageInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminProductsController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     */
    protected $productFetcher;

    public function __construct(ProductFetcherInterface $productFetcher)
    {
        $this->productFetcher = $productFetcher;
    }

    public function upload()
    {

    }

    public function index(Request $request)
    {
//        dd(session()->all());
//        dd(session()->all());

        $filters = $request->only(['quantityFrom', 'quantityTo', 'priceFrom', 'priceTo', 'category']);
        $name = $request->input('name', '');

        $categories = Category::all();

        $productsQuery = $this->productFetcher->getAllProducts()->where('product_type', 0);

        if ($name) {
            $productsQuery->where('product_name', 'like', '%' . $name . '%');
        }

        $products = $productsQuery->filter($filters)->paginate(8);
        return Inertia::render('Admin/Products/Index', [
            'filters' => $filters,
            'categories' => $categories,
            'name' => $name,
            'products' => $products,
//            dd($proudcts),

//            dd($this->productFetcher->getAllProducts()->where('product_type', 0)->filter($filters)->latest()->paginate(8))
        ]);
    }

    public function findProduct($productName)
    {

    }


//    public function index()
//    {
//        //
////        $customerId = auth()->user()->id;
//
//        $products = Product::with('productpricing', 'category')->where('product_type', 0)->latest()->get();
//        $categories = Category::all();
//        return Inertia::render('Admin/Products/Index', ['products' => $products, 'categories' => $categories]);
//    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return Inertia::render('Admin/Products/Create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FileStorageInterface $fileStorageService)
    {
        $imgPath = ''; // Define the variable with a default value
//        dd($request);

        // product_name: '',
        //    // product_type: '',
        //    // product_image: ' ',
        //    // image_extension: ' ',
        //    description: ' ',
        //    stock_quantity: ' ',
        //    // points_price: ' ',
        //    // cat_id: ' ',
        //    category: '',
        //    selling_price:'',
//        dd($request->product_image);

//        $request->validate([
//            'product_name' => 'required|string|max:255',
////            'product_image.*' => 'mimes:jpg,png,jpeg,webp|max:5000',
//            'description' => 'required|string',
//            'stock_quantity' => 'required|numeric|min:0',
//            'category' => 'required|exists:categories,id', // Assuming 'category' is a foreign key referencing a 'categories' table
//            'selling_price' => 'required|numeric|min:0',
//        ]);

//        dd($request->hasFile('product_image'));

        if ($request->hasFile('product_image')) {

            $imgPath = $fileStorageService->storeFile($request->product_image, '/public/uploads/productsImages');
        }
//            dd($imgPath);
//        dd(asset($imgPath));
//        dd(($request->product_image));
        $category = Category::where('category_name', $request->category)->first();
//        if($category){
//            $category->id=9;
//        }


        $product = Product::create([
            'product_name' => $request->product_name,
            'product_type' => 0,
            'description' => $request->description,
            'stock_quantity' => $request->stock_quantity,
            'points_price' => '0.00',
            'cat_id' => $category ?? 9,
            'favorite_count' => 0,
            'order_count' => 0,
            'product_image' => asset($imgPath)
        ]);
        ProductPricing::create([
            'product_id' => $product->id,
            'base_price' => $request->selling_price,
            'selling_price' => $request->selling_price,
            'discount' => 0,
        ]);
//        dd(session()->all());
        session()->flash('success', 'تم اضافة المنتج بنجاح');

        return redirect(route('admin.product.index'))
            ->with('success', 'تم اضافة المنتج بنجاح');

    }

    private function storeFile($file)
    {
        // Store the file with its original name
        return $file->storeAs('public/uploads', $file->getClientOriginalName());
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
    public function edit(Product $product)
    {
        //
//        print ($product);
//        Product::with('productpricing');
        $product->load('productpricing', 'category');
        $categories = Category::all();
        return Inertia::render('Admin/Products/Edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, FileStorageInterface $fileStorageService)
    {
        //
        $imgPath = ''; // Define the variable with a default value

//        dd($request);
//        $request->validate([
//            'product_name' => 'required|string|max:255',
////            'product_image.*' => 'mimes:jpg,png,jpeg,webp|max:5000',
//            'description' => 'required|string',
//            'stock_quantity' => 'required|numeric|min:0',
//            'category' => 'required|exists:categories,id', // Assuming 'category' is a foreign key referencing a 'categories' table
//            'selling_price' => 'required|numeric|min:0',
//        ]);

//        dd($request->hasFile('product_image'));
        $category = Category::where('category_name', $request->category)->first();

        if ($request->hasFile('product_image')) {

            $imgPath = $fileStorageService->storeFile($request->product_image, '/public/uploads/productsImages');
            $product->update([
                'product_image' => asset($imgPath),
            ]);
        }

        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'stock_quantity' => $request->stock_quantity,
            'cat_id' => $category->id,
            // Add other fields as necessary
        ]);
        $priceing = ProductPricing::where("product_id", $product->id);
        $priceing->update([
            'product_id' => $product->id,
            'selling_price' => $request->selling_price,
        ]);
//        dd(session()->all());
        session()->flash('success', 'تم اضافة المنتج بنجاح');

        return redirect(route('admin.product.index'))
            ->with('success', 'تم اضافة المنتج بنجاح');


// Add this line to check session data
//        return response()->json(['message' => 'Product updated successfully']);

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();

    }

    public function deleteProductImg(Product $product)
    {
        //
        $product->product_image = null;
        $product->save();

    }
}
