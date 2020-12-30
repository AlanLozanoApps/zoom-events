<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the chat can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list chats');
    }

    /**
     * Determine whether the chat can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Chat  $model
     * @return mixed
     */
    public function view(User $user, Chat $model)
    {
        return $user->hasPermissionTo('view chats');
    }

    /**
     * Determine whether the chat can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create chats');
    }

    /**
     * Determine whether the chat can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Chat  $model
     * @return mixed
     */
    public function update(User $user, Chat $model)
    {
        return $user->hasPermissionTo('update chats');
    }

    /**
     * Determine whether the chat can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Chat  $model
     * @return mixed
     */
    public function delete(User $user, Chat $model)
    {
        return $user->hasPermissionTo('delete chats');
    }

    /**
     * Determine whether the chat can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Chat  $model
     * @return mixed
     */
    public function restore(User $user, Chat $model)
    {
        return false;
    }

    /**
     * Determine whether the chat can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Chat  $model
     * @return mixed
     */
    public function forceDelete(User $user, Chat $model)
    {
        return false;
    }
}
