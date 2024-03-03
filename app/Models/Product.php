<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory;
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
        'cat_id'
    ];

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

    public function cart()
    {
        return $this->hasOne(Product::class, 'product_id', 'id');

    }

    public function orderMade()
    {
        return $this->hasMany(Product::class, 'product_id', 'id');
    }

    public $timestamps = false;
    protected $table = 'products'; // Adjust based on your table name
    protected $primaryKey = 'id'; //
}
