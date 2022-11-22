<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    protected $fillable = [
        'photo',
        'phone',
        'dateBirth',
        'placeBirth',
        'status',
        'user_id',
    ];

}
