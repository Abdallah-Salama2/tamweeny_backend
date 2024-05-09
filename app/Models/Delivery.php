<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'vehicle_type',
        'license_plate',
        ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    protected $table = 'delivery_guys'; // Adjust based on your table name


}
