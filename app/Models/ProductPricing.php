<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'Id',
        'product_id',
        'base_price',
        'selling_price',
        'discount',
        'discount_unit',
        'date_created',
        'exipred_date'

    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'Id');
    }

    protected $table = 'product_pricings'; // Adjust based on your table name
    protected $primaryKey = 'Id'; //
}
