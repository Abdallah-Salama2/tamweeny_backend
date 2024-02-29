<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernorAdmin extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'national_id'
    ];
    public function adminCard()
    {
        return $this->hasone(AdminCard::class, 'admin_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'national_id','national_id');
    }
}