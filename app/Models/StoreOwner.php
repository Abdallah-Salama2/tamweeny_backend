<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class storeOwner extends Model
{
    use HasFactory;
    use HasApiTokens;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'tax_registration_number',
        'national_id',
        'tax_card'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'national_id', 'nationalId');
    }

    protected $table = 'storeowner'; // Adjust based on your table name
    protected $primaryKey = 'id'; //
    public $timestamps = false;

}
