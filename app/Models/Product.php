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

    protected $hidden = [
        'productImage'
    ];

    protected $fillable = [
        'id',
        'product_name',
        'product_type',
        'product_image',
        'image_extension',
        'description',
        'stock_quantity',
        'points_price',
        'favorite_status',
        'store_id',
        'cat_id',
        'favorite_count',
        'order_count',
    ];
    use FavoriteScope;

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
        return $this->belongsToMany(Store::class,'stores_products');
    }
    public function cart()
    {
        return $this->hasOne(Cart::class, 'product_id', 'id');

    }

    public function orderMade()
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }

    public $timestamps = false;
    protected $table = 'products'; // Adjust based on your table name
    protected $primaryKey = 'id'; //



}
