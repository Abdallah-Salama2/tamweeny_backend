<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [

        'Id',
        'order_date',
        'order_price',
        'discount_code',
        'delivery_status',
        'payment_number',
        'customer_id',
        'delivery_id'
    ];


    protected $table = 'orders'; // Adjust based on your table name
    protected $primaryKey = 'Id'; //
}
