<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'customer_id',
        'product_id',
        'quantity',
        'total_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function order_made()
    {
        return $this->hasMany(Orders_made::class, 'cart_item_id', 'id');
    }

    public $timestamps = false;
    protected $table = 'cart'; // Adjust based on your table name
    protected $primaryKey = 'id'; //

}
