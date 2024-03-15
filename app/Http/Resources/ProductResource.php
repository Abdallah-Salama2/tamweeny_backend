<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'productName' => $this->product_name,
            'productType' => $this->product_type,
            'productImage' => $this->product_image,
            'imageExtension' => $this->image_extension,
            'description' => $this->description,
            'stockQuantity' => $this->stock_quantity,
            'pointsPrice' => $this->points_price,
            'storeId' => (int)$this->store_id,
            'categoryId' => (int)$this->cat_id,
            'favoriteCount	'=>$this->favorite_count,
            'orderCount'=>$this->order_count,
            'categoryName' => $this->category->category_name,
            'categoryImage' => $this->category->category_image,
            'categoryIcon' => $this->category->category_icon,
            'basePrice' => $this->productpricing->base_price,
            'sellingPrice' => $this->productpricing->selling_price,
            'discount' => $this->productpricing->discount,
            'discountUnit' => $this->productpricing->discount_unit,
            'datCreated' => $this->productpricing->date_created,
            'exipredDate' => $this->productpricing->exipred_date,
//            'favoriteStats' => $this->favoriteStats ? 1 : 0,
            'favoriteStats' => $this->when(isset($this->favoriteStats), $this->favoriteStats),

        ];
    }
}
//
//If favoriteStats is not a column in your database table, and you want to include it in your response based on whether a product is a favorite for the current user, you can manually add it to the ProductResource without relying on the database.
//
