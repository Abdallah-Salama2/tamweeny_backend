
public function productsByCategory($catName, Request $request): JsonResponse
{
//        $userId = $request->user()->id;
//        $user = User::with('customer', 'customer.card')->find($userId);
//        $customerId = $user->customer->id;
$customerId = auth()->user()->id;
$category = Category::where('category_name', $catName)->firstOrFail();
$customerFavoriteProductIds = Favorite::where('customer_id', $customerId)
->pluck('product_id')
->toArray();
$products = Product::where('cat_id', $category->id)
//            ->with('productpricing', 'category')
->get();

// Transform products using ProductResource and set favoriteStats based on if they are favorites
$products->each(function ($product) use ($customerFavoriteProductIds) {
$product->favoriteStats = in_array($product->id, $customerFavoriteProductIds) ? 1 : 0;
});

return response()->json(ProductResource::collection($products));
}
