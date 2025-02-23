<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('god')) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Tag $tag): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Tag $tag): bool
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Tag $tag): bool
    {
        return $user->hasRole('admin');
    }

    public function restore(User $user, Tag $tag): bool
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, Tag $tag): bool
    {
        return $user->hasRole('admin');
    }
}
