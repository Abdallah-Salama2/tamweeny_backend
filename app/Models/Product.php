<?php

namespace App\Models;

use App\Models\Scopes\FavoriteScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;
    use FavoriteScope;

    protected $hidden = [
    ];

    protected $fillable = [
        'id', 'product_name', 'product_type', 'product_image', 'image_extension',
        'description', 'stock_quantity', 'points_price', 'favorite_status',
        'store_id', 'cat_id', 'favorite_count', 'order_count'
    ];

    protected $sortable = ['cat_id', 'product_pricings.selling_price', 'stock_quantity'];
    public $timestamps = false;
    protected $table = 'products';
    protected $primaryKey = 'id';


    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    public function productpricing()
    {
        return $this->hasOne(ProductPricing::class, 'product_id', 'id');

    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class, 'product_id', 'id');
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'stores_products');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'product_id', 'id');

    }

    public function orderMade()
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }

    public function scopeSearch(Builder $query, string $name): Builder
    {
     return $query->when($name ?? false,
     function ($query,$value){
         return $query->where('product_name','=',$value);
     });
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        // Join with the product_pricing table
        $query->join('product_pricings', 'products.id', '=', 'product_pricings.product_id');
//        $query->join('categories','products.cat_id','=','categories.id');


        return $query->when(
            $filters['quantityFrom'] ?? false,
            function ($query, $value) {
                return $query->where('stock_quantity', '>=', $value);
            }
        )->when($filters['quantityTo'] ?? false,
            fn($query, $value) => $query->where('stock_quantity', '<=', $value)->orderBy('stock_quantity', 'ASC')
        )->when(
            $filters['priceFrom'] ?? false,
            function ($query, $value) {
                return $query->where('product_pricings.selling_price', '>=', $value)->orderBy('product_pricings.selling_price', 'ASC');
            }
        )->when($filters['priceTo'] ?? false,
            fn($query, $value) => $query->where('product_pricings.selling_price', '<=', $value)
        )->when(
                $filters['category'] ?? false,
                fn($query, $value) => $query->where('cat_id', '=', $value)
            );

    }


}


//    public function scopeWithFavoriteStatus($query, $userId)
//    {
//        return $query->with(['favorite' => function ($query) use ($userId) {
//            $query->where('customer_id', $userId);
//        }]);
//    }

//    public function getRouteKeyName()
//    {
//        return request()->route('product') === (string)(int)request()->route('product') ? 'id' : 'product_name';
//        //This method checks if the user route parameter is a numeric string (which would typically indicate an ID). If it is, it returns 'id' as the route key name; otherwise, it returns 'name'
//    }

