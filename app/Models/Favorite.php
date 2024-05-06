<?php

namespace App\Models;

use App\Models\Product;;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'customer_id',
        'product_id'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class, 'customer_id', 'id');

    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');

    }

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'favorites';
}
