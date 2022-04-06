<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class MuseumDepartment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'museum_images', 'images_id', 'museum_id');
    }


}
