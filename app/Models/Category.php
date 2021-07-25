<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //protected $with = ['albums'];

    public function albums()
    {
        return $this->belongsToMany(Album::class);
    }

}
