<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        // Fields for the Customer model
        'national_id', // Assuming you have a column named 'national_id' for the foreign key
        'tamweenCardId'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'national_id', 'nationalId');
    }

    public function card()
    {
        return $this->belongsTo(Card::class, 'tamweenCardId', 'cardId');
    }
    protected $table = 'customer'; // Adjust based on your table name
    protected $primaryKey = 'customerId'; //


}
