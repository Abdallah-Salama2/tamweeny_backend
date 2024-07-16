<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\trait\GeneralTrait;
use App\Interfaces\Product\ProductFetcherInterface;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPricing;
use App\Models\Store;
use App\Services\FileStorage\Interfaces\FileStorageInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminProductsController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filters = $request->only(['quantityFrom', 'quantityTo', 'priceFrom', 'priceTo', 'category']);
        $name = $request->input('name', '');

        $categories = Category::all();
        if (auth()->user()->user_type == 'Admin') {
            $productsQuery = Product::with(['productpricing', 'category'])->where('product_type', 0);
            if ($name) {
                $productsQuery->where('product_name', 'like', '%' . $name . '%');
            }

            $products = $productsQuery->filter($filters)->latest()->paginate(8);
            return Inertia::render('Admin/Products/Index', [
                'filters' => $filters,
                'categories' => $categories,
                'name' => $name,
                'products' => $products,
//            dd($proudcts),

            ]);
        } else {

            $ownerid = auth()->user()->id;
            //quick note we use first cuz it return single row get return collection of rows
            // so to use get $storeId=Store::where("owner_id",$ownerid)->get()    $stores=[];
            //            foreach ($storeId as $store) {
            //                $stores[]= $store->id; // Accessing id for each store in the collection
            //            }
            $storeId = Store::where("owner_id", $ownerid)->first()->id;
//            $name = 'سكر'; // Example value for testing, you can change it to any test name

            $productsQuery = Product::join('stores_products', 'products.id', '=', 'stores_products.product_id')
                ->join('stores', 'stores.id', '=', 'stores_products.store_id')
                ->select(
                    'stores_products.product_id as id',
                    'product_name',
                    'product_type',
                    'product_image',
                    'description',
                    'stores_products.quantity as stock_quantity',
                    'products.cat_id',
                    'base_price',
                    'selling_price',
                    'discount',
                    'discount_unit'
                )
                ->where('stores_products.store_id', '=', $storeId);

            if ($name) {
                $productsQuery->where('product_name', 'like', '%' . $name . '%');
            }

            $products = $productsQuery->filter($filters)->paginate(8);
            $products->load('productpricing', 'category');

//            dd($products);
            return Inertia::render('Admin/Products/Index', [
                'filters' => $filters,
                'categories' => $categories,
                'name' => $name,
                'products' => $products,
//            dd($proudcts),

            ]);
//            dd($productsQuery);

        }

//        $products = Product::with(['stores' => function($query) {
//            $query->where('store_id', 1);
//        }])->whereHas('stores', function($query) {
//            $query->where('store_id', 1);
//        })->get();


    }

    public function findProduct($productName)
    {

    }

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


        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_image.*' => 'mimes:jpg,png,jpeg,webp|max:5000',
            'description' => 'required|string',
            'stock_quantity' => 'required|numeric|min:0',
            'category' => 'required|exists:categories,id', // Assuming 'category' is a foreign key referencing a 'categories' table
            'selling_price' => 'required|numeric|min:0',
        ]);
//        dd($request->all());

//        dd($request->hasFile('product_image'));

        if ($request->hasFile('product_image')) {

            $imgPath = $fileStorageService->storeFile($request->product_image, '/public/uploads/productsImages');
        }

        $category = Category::where('category_name', $request->category)->first();

        if (auth()->user()->user_type == "Admin") {
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
            $stores=Store::all();
            foreach ($stores as $store){
                $store->products()->attach($product,['quantity'=>1,'created_at'=>now(),'updated_at'=>now()]);
            }
            session()->flash('success', 'تم اضافة المنتج بنجاح');

            return redirect(route('admin.product.index'))
                ->with('success', 'تم اضافة المنتج بنجاح');
        } else {
            $ownerid = auth()->user()->id;
            $store = Store::where("owner_id", $ownerid)->first();
            $product = Product::create([
                'product_name' => $request->product_name,
                'product_type' => 1,
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
            $store->products()->attach($product,['quantity'=>$request->stock_quantity,'created_at'=>now(),'updated_at'=>now()]);
            return redirect(route('supplier.offer.index'))
                ->with('success', 'تم اضافة المنتج بنجاح');
        }
//        dd(session()->all());


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

    public function increase_quantity(Product $product)
    {
        //
        $ownerid = auth()->user()->id;
        $store = Store::where("owner_id", $ownerid)->first();
        $store->request=1;
        $store->save();
//        dd($store->products()->);
        $store->products()->updateExistingPivot($product, ['quantity_increase_request' => 1]);

//        dd($product);
    }

    public function deleteProductImg(Product $product)
    {
        //
        $product->product_image = null;
        $product->save();

    }
}
