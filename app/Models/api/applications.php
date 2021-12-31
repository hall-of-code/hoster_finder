<?php

namespace App\Models\api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class applications extends Model
{
    protected $fillable = [
        'app_name',
    ];

    use HasFactory;
}
