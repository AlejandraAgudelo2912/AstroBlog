<?php

namespace App\Policies;

use App\Models\ObservationPoint;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ObservationPointPolicy
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

    public function view(User $user, ObservationPoint $observationPoint): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('user') || $user->hasRole('admin');
    }

    public function update(User $user, ObservationPoint $observationPoint): bool
    {
        return $user->id === $observationPoint->user_id || $user->hasRole('admin');
    }

    public function delete(User $user, ObservationPoint $observationPoint): bool
    {
        return $user->id === $observationPoint->user_id || $user->hasRole('admin');
    }

    public function restore(User $user, ObservationPoint $observationPoint): bool
    {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, ObservationPoint $observationPoint): bool
    {
        return $user->hasRole('admin');
    }
}
