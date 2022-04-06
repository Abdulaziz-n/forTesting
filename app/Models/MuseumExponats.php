<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuseumExponats extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'date_exp',
    ];
}
