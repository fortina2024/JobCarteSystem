<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TypeService;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypeServicePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TypeService');
    }

    public function view(AuthUser $authUser, TypeService $typeService): bool
    {
        return $authUser->can('View:TypeService');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TypeService');
    }

    public function update(AuthUser $authUser, TypeService $typeService): bool
    {
        return $authUser->can('Update:TypeService');
    }

    public function delete(AuthUser $authUser, TypeService $typeService): bool
    {
        return $authUser->can('Delete:TypeService');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:TypeService');
    }

    public function restore(AuthUser $authUser, TypeService $typeService): bool
    {
        return $authUser->can('Restore:TypeService');
    }

    public function forceDelete(AuthUser $authUser, TypeService $typeService): bool
    {
        return $authUser->can('ForceDelete:TypeService');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TypeService');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TypeService');
    }

    public function replicate(AuthUser $authUser, TypeService $typeService): bool
    {
        return $authUser->can('Replicate:TypeService');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TypeService');
    }

}