<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Store extends Model
{
    use HasFactory;
    use HasApiTokens;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'owner_id',
        'store_name',
        'address',
        'phone_number',
        'type',
        'valid',
        'latitude',
        'longitude',
    ];

    protected $table = 'stores'; // Adjust based on your table name
    protected $primaryKey = 'id'; //s
    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class,'stores_products')->withPivot('quantity');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'owner_id','id');
    }
    public function order()
    {
        return $this->hasMany(Order::class, 'store_id', 'id');
    }


}
