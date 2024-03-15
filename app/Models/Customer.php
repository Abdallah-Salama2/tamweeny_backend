<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        // Fields for the Customer model
        'id',
        'national_id', // Assuming you have a column named 'national_id' for the foreign key
        'card_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'national_id', 'national_id');
    }

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id', 'id');
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class, 'customer_id', 'id');
    }
    public function cart()
    {
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function order_made()
    {
        return $this->hasMany(Orders_made::class, 'customer_id', 'id');
    }


    protected $table = 'customers'; // Adjust based on your table name
    protected $primaryKey = 'id'; //


}
