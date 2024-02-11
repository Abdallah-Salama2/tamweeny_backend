<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{
    use HasApiTokens;
    use HasFactory, Notifiable;

    protected $fillable=[
        'catId',
        'catName',

    ];

    public function category()
    {
        return $this->hasOne(Product::class, 'cat_Id', 'catId');
    }
    protected $table = 'category'; // Adjust based on your table name
    protected $primaryKey = 'catId'; //
}
