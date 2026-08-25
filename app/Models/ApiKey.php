<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    protected $fillable = ['client_name', 'key', 'expires_at'];
    protected $casts = ['expires_at' => 'datetime'];
}
