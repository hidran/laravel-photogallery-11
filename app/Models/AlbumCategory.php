<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\AlbumCategory
 *
 * @property int $id
 * @property int $album_id
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumCategory whereAlbumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumCategory whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AlbumCategory extends Pivot
{
    //
}
