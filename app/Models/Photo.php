<?php

namespace App\Models;

use Database\Factories\PhotoFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Photo
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property string $name
 * @property string|null $description
 * @property int $album_id
 * @property string $img_path
 * @method static PhotoFactory factory(...$parameters)
 * @method static Builder|Photo newModelQuery()
 * @method static Builder|Photo newQuery()
 * @method static \Illuminate\Database\Query\Builder|Photo onlyTrashed()
 * @method static Builder|Photo query()
 * @method static Builder|Photo whereAlbumId($value)
 * @method static Builder|Photo whereCreatedAt($value)
 * @method static Builder|Photo whereDeletedAt($value)
 * @method static Builder|Photo whereDescription($value)
 * @method static Builder|Photo whereId($value)
 * @method static Builder|Photo whereImgPath($value)
 * @method static Builder|Photo whereName($value)
 * @method static Builder|Photo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Photo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Photo withoutTrashed()
 * @property-read \App\Models\Album $album
 * @property-read mixed $path
 * @mixin Eloquent
 */
class Photo extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function getPathAttribute()
    {
        $url = $this->img_path;
        if (!str_starts_with($url, 'http')) {
            $url = 'storage/' . $url;
        }
        return $url;
    }
}
