<?php

namespace App\Models;

use App\Models\Product;;
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

    protected $fillable = [
        'id',
        'category_name',
        'category_image',
        'category_icon'

    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'cat_id', 'id');
    }

    public $timestamps = false;

    protected $table = 'categories'; // Adjust based on your table name
    protected $primaryKey = 'id'; //
}
