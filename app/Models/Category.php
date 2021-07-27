<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    //protected $with = ['albums'];

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class)->withTimestamps();
    }

}
