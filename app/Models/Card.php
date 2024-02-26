<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'id',
        'card_name',
        'card_number',
        'card_national_id',
        'card_password',
        'individuals_number',
        'bread_points',
        'tamween_points',
        'customer_id'

    ];


    // Relationship with Customer model
    public function customer()
    {
        return $this->hasOne(Customer::class, 'card_id', 'id');
    }

    public $timestamps = false;
    protected $table = 'cards'; // Adjust based on your table name
    protected $primaryKey = 'id'; //


}
