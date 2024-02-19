<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        // Fields for the Customer model
        'Id',
        'national_id', // Assuming you have a column named 'national_id' for the foreign key
        'card_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'national_id', 'national_id');
    }

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id', 'Id');
    }

    protected $table = 'customers'; // Adjust based on your table name
    protected $primaryKey = 'Id'; //


}
