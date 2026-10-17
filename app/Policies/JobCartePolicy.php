<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\JobCarte;
use Illuminate\Auth\Access\HandlesAuthorization;

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
        return $authUser->can('Delete:JobCarte');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:JobCarte');
    }

    public function restore(AuthUser $authUser, JobCarte $jobCarte): bool
    {
        return $authUser->can('Restore:JobCarte');
    }

    public function forceDelete(AuthUser $authUser, JobCarte $jobCarte): bool
    {
        return $authUser->can('ForceDelete:JobCarte');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:JobCarte');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:JobCarte');
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