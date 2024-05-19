<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'card_name',
        'card_number',
        'card_national_id',
        'card_password',
        'individuals_number',
        'bread_points',
        'tamween_points',

    ];


    // Relationship with Customer model
    public function user()
    {
        return $this->belongsTo(User::class, 'card_id', 'id');
    }

    protected $table = 'cards'; // Adjust based on your table name
    protected $primaryKey = 'id'; //


}
