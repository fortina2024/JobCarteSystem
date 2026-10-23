<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\JobCarte;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class JobCartePolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:JobCarte');
    }

    public function view(AuthUser $authUser, JobCarte $jobCarte): bool
    {
        return $authUser->can('View:JobCarte');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:JobCarte');
    }

    public function update(AuthUser $authUser, JobCarte $jobCarte): bool
    {
        return $authUser->can('Update:JobCarte');
    }

    public function delete(AuthUser $authUser, JobCarte $jobCarte): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function restore(AuthUser $authUser, JobCarte $jobCarte): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function forceDelete(AuthUser $authUser, JobCarte $jobCarte): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->hasRole('super_admin');
    }

    public function replicate(AuthUser $authUser, JobCarte $jobCarte): bool
    {
        return $authUser->can('Replicate:JobCarte');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:JobCarte');
    }
}
