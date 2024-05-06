<?php

namespace App\Models;

use App\Models\Product;;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Orders_made extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'product_name',
        'quantity',
        'total_price',
        'customer_id',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_item_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }


    protected $table = 'orders_made'; // Adjust based on your table name
    protected $primaryKey = 'id'; //

}
