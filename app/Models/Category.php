<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $category_name
 * @property int $user_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Album[] $albums
 * @property-read int|null $albums_count
 * @method static CategoryFactory factory(...$parameters)
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCategoryName($value)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereDeletedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @method static Builder|Category whereUserId($value)
 * @property-read \App\Models\User $user
 * @method static Builder|Category getCategoriesByUserId(\App\Models\User $user)
 * @mixin Eloquent
 */
class Category extends Model
{
    use HasFactory;

    //protected $with = ['albums'];
    protected $fillable = ['category_name', 'user_id'];

    public function albums(): BelongsToMany
    {
        return $this->belongsToMany(Album::class)->withTimestamps();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGetCategoriesByUserId(
        Builder $builder,
        User $user
    ): void {
        $builder->whereUserId($user->id)->withCount('albums')->orderBy('category_name');
    }

}
