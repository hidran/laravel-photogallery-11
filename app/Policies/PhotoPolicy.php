<?php

namespace App\Policies;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return (bool)$user->id;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Photo $photo
     * @return bool
     */
    public function view(User $user, Photo $photo): bool
    {
        return $user->id === $photo->album->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return (bool)$user->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Photo $photo
     * @return bool
     */
    public function update(User $user, Photo $photo): bool
    {
        return $user->id === $photo->album->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Photo $photo
     * @return bool
     */
    public function delete(User $user, Photo $photo): bool
    {
        return $user->id === $photo->album->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Photo $photo
     * @return bool
     */
    public function restore(User $user, Photo $photo): bool
    {
        return $user->id === $photo->album->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Photo $photo
     * @return bool
     */
    public function forceDelete(User $user, Photo $photo): bool
    {
        return $user->id === $photo->album->user_id;
    }
}
