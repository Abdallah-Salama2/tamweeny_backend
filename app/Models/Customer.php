<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        // Fields for the Customer model
        'id',
        'user_id', // Assuming you have a column named 'national_id' for the foreign key
        'card_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }



    protected $table = 'customers'; // Adjust based on your table name
    protected $primaryKey = 'id'; //


}
