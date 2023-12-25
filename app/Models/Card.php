<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'id',
        'CardName',
        'CardNumber',
        'CardNationalId',
        'CardPassword',
        'Individuals Number',
        'BreadPoints',
        'TamweenPoints',
    ];

    // Relationship with Customer model
    public function customer()
    {
        return $this->hasOne(Customer::class, 'TamweencardId', 'id');
    }
    protected $table = 'cards'; // Adjust based on your table name


}
