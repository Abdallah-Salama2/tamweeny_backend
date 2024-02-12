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
        'storeId',
        'owner_id',
        'storeName',
        'address',
        'phoneNumber',
        'type',
        'valid',
        'latitude',
        'longitude'
    ];

    protected $table = 'store'; // Adjust based on your table name
    protected $primaryKey = 'storeId'; //s
}
