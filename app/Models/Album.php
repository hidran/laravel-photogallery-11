<?php

namespace App\Models;

use Database\Factories\AlbumFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Album
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $album_name
 * @property string $album_thumb
 * @property string|null $description
 * @property int $user_id
 * @property Carbon|null $deleted_at
 * @property-read Collection|Photo[] $photos
 * @property-read int|null $photos_count
 * @method static AlbumFactory factory(...$parameters)
 * @method static Builder|Album newModelQuery()
 * @method static Builder|Album newQuery()
 * @method static \Illuminate\Database\Query\Builder|Album onlyTrashed()
 * @method static Builder|Album query()
 * @method static Builder|Album whereAlbumName($value)
 * @method static Builder|Album whereAlbumThumb($value)
 * @method static Builder|Album whereCreatedAt($value)
 * @method static Builder|Album whereDeletedAt($value)
 * @method static Builder|Album whereDescription($value)
 * @method static Builder|Album whereId($value)
 * @method static Builder|Album whereUpdatedAt($value)
 * @method static Builder|Album whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Album withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Album withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\User $user
 * @property-read string $path
 * @mixin Eloquent
 */
class Album extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $table = 'albums';
    // protected $primaryKey = 'album_name';
    protected $fillable = [
        'album_name',
        'description',
        'user_id',
        'album_thumb'
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }

    public function getPathAttribute(): string
    {
        $url = $this->album_thumb;
        if (!str_starts_with($url, 'http')) {
            $url = asset('storage/' . $url);
        }
        return $url;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        // album_category , album_id, category_id
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
