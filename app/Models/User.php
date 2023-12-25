<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken as SanctumToken;


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
        'NationalId',
        'Name',
        'email',
        'password',
        'Phone_number',
        'City',
        'State',
        'Street',
        'BirthDate',
        'UserType',
        'Latitude',
        'Longitude',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'national_id', 'NationalId');
    }


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user'; // Adjust based on your table name
    protected $primaryKey = 'NationalId'; //


}

