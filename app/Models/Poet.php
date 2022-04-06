<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poet extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'date_of_birth',
      'birth_location',
      'date_of_death',
      'description',
      'position',
      'image',
      'video_gallery',
      'audio',
      'file'
    ];

    public function links()
    {
        return $this->belongsToMany(Link::class, 'poet_links', 'poet_id', 'link_id');
    }
}
