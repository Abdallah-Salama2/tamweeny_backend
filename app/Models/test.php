<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'unit_price',
    ];
    public $timestamps = false;

    protected $table = 'test';
    protected $primaryKey = 'id';
}
