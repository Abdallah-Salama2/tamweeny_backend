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
        'Id',
        'product_name',
        'product_type',
        'product_image',
        'image_extension',
        'description',
        'stock_quantity',
        'points_price',
        'store_id',
        'cat_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'Id');
    }

    public function productpricing()
    {
        return $this->hasOne(ProductPricing::class, 'product_id', 'Id');

    }

    protected $table = 'products'; // Adjust based on your table name
    protected $primaryKey = 'Id'; //
}
