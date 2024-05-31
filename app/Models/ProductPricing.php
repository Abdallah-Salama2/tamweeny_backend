<?php

namespace App\Models;

use App\Models\Product;;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'product_id',
        'base_price',
        'selling_price',
        'discount',
        'discount_unit',
        'date_created',
        'exipred_date'

    ];

    protected $sortable=['selling_price'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    protected $table = 'product_pricings'; // Adjust based on your table name
    protected $primaryKey = 'id'; //
    public $timestamps = false; //

}
