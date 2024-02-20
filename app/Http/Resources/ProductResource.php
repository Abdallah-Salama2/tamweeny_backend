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
            'id' => $this->Id,
            'productName' => $this->product_name,
            'productType' => $this->product_type,
            'productImage' => $this->product_image,
            'imageExtension' => $this->image_extension,
            'description' => $this->description,
            'stockQuantity' => $this->stock_quantity,
            'pointsPrice' => $this->points_price,
            'storeId' => $this->store_id,
            'categoryId' => $this->cat_id,
            'categoryName' => $this->category->category_name,
            'categoryImage' => $this->category->category_image,
            'basePrice' => $this->productpricing->base_price,
            'sellingPrice' => $this->productpricing->selling_price,
            'discount' => $this->productpricing->discount,
            'discountUnit' => $this->productpricing->discount_unit,
            'datCreated' => $this->productpricing->date_created,
            'exipredDate' => $this->productpricing->exipred_date
        ];
    }
}
