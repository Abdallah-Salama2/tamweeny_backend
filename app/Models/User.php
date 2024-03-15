<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'national_id',
        'name',
        'email',
        'password',
        'phone_number',
        'city_state',
        'street',
        'birth_date',
        'user_type',
        'latitude',
        'longitude',
//        'created_at',
//        'last_login_at'
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'national_id', 'national_id');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public $timestamps = true;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function storeOwner()
    {
        return $this->hasOne(StoreOwner::class, 'national_id', 'national_id');
    }

    public function governorAdmin()
    {
        return $this->hasOne(GovernorAdmin::class, 'national_id','national_id');
    }


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users'; // Adjust based on your table name
    protected $primaryKey = 'national_id'; //


}

