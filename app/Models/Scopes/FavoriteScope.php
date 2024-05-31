<?php

namespace App\Models\Scopes;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

/**
 * @method static addGlobalScope(string $string, \Closure $param)
 */
trait FavoriteScope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function scopeWithFavoriteStatus($query, $userId)
    {
        //make sure favorites is the same as relation name in product model
        return $query->with(['favorite' => function ($query) use ($userId) {
            $query->where('customer_id', $userId);
        }]);
    }

    public static function bootFavoriteScope()
    {
        static::addGlobalScope('withFavoriteStatus', function (Builder $builder) {
            if (Auth::check()) {
                $userId = auth()->user()->id;
                $builder->withFavoriteStatus($userId);
            }
        });
    }
}
/*
Certainly! Let's break down the FavoriteScope trait and its usage:

1. scopeWithFavoriteStatus Method:
php
Copy code
public function scopeWithFavoriteStatus($query, $userId)
{
    return $query->with(['favorite' => function ($query) use ($userId) {
        $query->where('customer_id', $userId);
    }]);
}
This method defines a scope called withFavoriteStatus. Scopes are special query builder methods that allow you to encapsulate common query constraints.
It takes two parameters: $query, which represents the Eloquent query builder instance, and $userId, which is the ID of the user whose favorite status you want to check.
Within the scope, it loads the favorite relationship using eager loading (with) and adds a constraint to filter the related favorites by the given $userId.
2. bootFavoriteScope Method:
php
Copy code
public static function bootFavoriteScope()
{
    static::addGlobalScope('withFavoriteStatus', function (Builder $builder) {
        $userId = auth()->user()->customer->id;
        $builder->withFavoriteStatus($userId);
    });
}
This method is a bootstrapping method that automatically adds the withFavoriteStatus global scope to the model when it boots up.
It's a convention in Laravel to name bootstrapping methods starting with boot.
Inside this method, it calls addGlobalScope method, passing the scope name 'withFavoriteStatus' and a closure.
The closure receives the query builder instance $builder, retrieves the current authenticated user's ID ($userId), and applies the withFavoriteStatus scope defined earlier.
Usage in a Model:
php
Copy code
use App\Scopes\FavoriteScope;

class Product extends Model
{
    use FavoriteScope;

    // Other model code...
}
To use the FavoriteScope trait in a model, you simply include it using the use keyword.
This allows the model to utilize both the scopeWithFavoriteStatus method for specific queries and the bootFavoriteScope method to automatically apply the global scope.
In summary, the FavoriteScope trait provides a convenient way to encapsulate logic related to handling favorite status in Eloquent models. It encapsulates the logic for loading favorite relationships and applies it both as a local scope and a global scope.


User
so now give an example what is the output of query
ChatGPT
Sure, let's say we have a Product model with the FavoriteScope trait applied. We want to retrieve a collection of products along with their favorite status for a specific user.

Here's an example query:

php
Copy code
$userId = 1; // Assume the user ID is 1 for this example

$products = Product::withFavoriteStatus($userId)->get();
In this example:

We're retrieving all products (Product::) along with their favorite status for a specific user.
We use the withFavoriteStatus($userId) scope to include the favorite status for the specified user.
We call get() to execute the query and retrieve the collection of products.
Now, let's assume we have two products in the database:

Product 1:

ID: 1
Name: "Product A"
Description: "This is product A"
Product 2:

ID: 2
Name: "Product B"
Description: "This is product B"
And let's say that for this user (with ID 1), "Product A" is marked as a favorite.

The output of the query $products would be something like this:

php
Copy code
[
    {
        "id": 1,
        "name": "Product A",
        "description": "This is product A",
        "favorite": {
    "id": 1,
            "customer_id": 1,
            "product_id": 1,
            "created_at": "2024-05-06 10:00:00",
            "updated_at": "2024-05-06 10:00:00"
        }
    },
    {
        "id": 2,
        "name": "Product B",
        "description": "This is product B",
        "favorite": null
    }
]
In this output:

Product A (id: 1) has a favorite record associated with it, indicating that it's marked as a favorite for the user with ID 1.
Product B (id: 2) does not have a favorite record associated with it, indicating that it's not marked as a favorite for the user with ID 1. Therefore, the favorite attribute is null for Product B.


favorite stats returns 1 or 0 happens in product resource

*/
