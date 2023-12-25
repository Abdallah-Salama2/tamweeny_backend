<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        // Fields for the Customer model
        'National_Id', // Assuming you have a column named 'national_id' for the foreign key
        'TamweencardId'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'National_Id', 'NationalId');
    }

    public function tamweenCard()
    {
        return $this->belongsTo(Card::class, 'TamweencardId', 'id');
    }
    protected $table = 'customer'; // Adjust based on your table name

}
