<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory, Notifiable;
    use HasRoles;

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
        'store_owner_info',
        'delivery_info'
//        'created_at',
//        'last_login_at'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];



    public function getRouteKeyName()
    {
        return request()->route('user') === (string)(int)request()->route('user') ? 'id' : 'name';
        //This method checks if the user route parameter is a numeric string (which would typically indicate an ID). If it is, it returns 'id' as the route key name; otherwise, it returns 'name'
    }



    /*In your example, you have a resource route defined for 'users':


    Route::resource('users', 'Api\UserController');
    This resource route automatically maps the following CRUD actions to the controller methods:

    GET /users - index method
    GET /users/{user} - show method
    PUT/PATCH /users/{user} - update method
    DELETE /users/{user} - destroy method
    In this context, the parameter 'user' in the route refers to the placeholder for the user's identifier, which could be either the user's ID or name, based on the logic you implemented in getRouteKeyName().

    So, when you call request()->route('user'), Laravel retrieves the value of the 'user' route parameter, whether it's an ID or a name, depending on your implementation in getRouteKeyName().*/

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public $timestamps = true;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'delivery_info' => 'array',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function getDeliveryInfoAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setDeliveryInfoAttribute($value)
    {
        $this->attributes['delivery_info'] = json_encode($value);
    }

    public function incrementOrderCount()
    {
        $deliveryInfo = $this->delivery_info;
        $deliveryInfo['order_count'] = isset($deliveryInfo['order_count']) ? $deliveryInfo['order_count'] + 1 : 1;
        $this->delivery_info = $deliveryInfo;
        $this->save();
    }


    public function card()
    {
        return $this->hasOne(Card::class, 'user_id', 'id');
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class, 'customer_id', 'id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function order_made()
    {
        return $this->hasMany(Orders_made::class, 'customer_id', 'id');
    }


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users'; // Adjust based on your table name
    protected $primaryKey = 'id'; //


}

