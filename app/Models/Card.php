<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'cardId',
        'cardName',
        'cardNumber',
        'cardNationalId',
        'cardPassword',
        'individualsNumber',
        'breadPoints',
        'tamweenPoints',
    ];

    // Relationship with Customer model
    public function customer()
    {
        return $this->hasOne(Customer::class, 'tamweenCardId', 'cardId');
    }
    protected $table = 'cards'; // Adjust based on your table name
    protected $primaryKey = 'cardId'; //


}
