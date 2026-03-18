<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appercamel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'address',
        'building',
        'tel',
        'gender',
        'inquiry_type',
        'content',
    ];
}
