<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementCentre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'image',
        'description',
        'phone',
        'tg_link',
        'insta_link',
        'fb_link',
        'email'
    ];
}
