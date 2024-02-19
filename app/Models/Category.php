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
//    protected $hidden=[
//        'catImage'
//    ];

    protected $fillable=[
        'Id',
        'category_name',
        'category_image',

    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'cat_id', 'Id');
    }

    protected $table = 'categories'; // Adjust based on your table name
    protected $primaryKey = 'Id'; //
}
