<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminCard extends Model
{
    protected $fillable = [
        'admin_id', 'card_number', 'card_national_id', 'cardName', 'individuals_number',
        'tamween_points', 'bread_points', 'name', 'gender', 'email', 'social_status','phone_number','salary', 'national_id_card_and_birth_certificate', 'followers_national_id_cards_and_birth_certificates'
    ];

    public function governorAdmin()
    {
        return $this->belongsTo(GovernorAdmin::class, 'admin_id','id');
    }
}
