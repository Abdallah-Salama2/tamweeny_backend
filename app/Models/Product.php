<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory;
    use HasFactory, Notifiable;

    protected $fillable=[
        'productId',
        'productName',
        'productType',
        'productImage',
        'description',
        'stock_quantity',
        'pointsPrice',
        'store_id',
        'cat_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'catId');
    }
    public function pricing(){
        return $this->hasOne(ProductPricing::class, 'product_id', 'productId');

    }
    protected $table = 'product'; // Adjust based on your table name
    protected $primaryKey = 'productId'; //
}
