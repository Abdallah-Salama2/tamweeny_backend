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

    public function getRouteKeyName()
    {
        return 'category_name';
        //This method checks if the user route parameter is a numeric string (which would typically indicate an ID). If it is, it returns 'id' as the route key name; otherwise, it returns 'name'
    }
    public $timestamps = false;

    protected $table = 'categories'; // Adjust based on your table name
    protected $primaryKey = 'id'; //
}
