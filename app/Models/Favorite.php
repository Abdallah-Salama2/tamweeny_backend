<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected  $fillable=[
      'Id',
      'customer_id',
      'product_id'
    ];

    public $timestamps=false;

    public function product(){
        return $this->belongsTo(Product::class,'customer_id','Id');

    }
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','Id');

    }

    protected  $primaryKey='Id';
    protected $table='favorites';
}
