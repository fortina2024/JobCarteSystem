<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Inspection;
use Illuminate\Auth\Access\HandlesAuthorization;

class InspectionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Inspection');
    }

    public function view(AuthUser $authUser, Inspection $inspection): bool
    {
        return $authUser->can('View:Inspection');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Inspection');
    }

    public function update(AuthUser $authUser, Inspection $inspection): bool
    {
        return $authUser->can('Update:Inspection');
    }

    public function delete(AuthUser $authUser, Inspection $inspection): bool
    {
        return $authUser->can('Delete:Inspection');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Inspection');
    }

    public function restore(AuthUser $authUser, Inspection $inspection): bool
    {
        return $authUser->can('Restore:Inspection');
    }

    public function forceDelete(AuthUser $authUser, Inspection $inspection): bool
    {
        return $authUser->can('ForceDelete:Inspection');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Inspection');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Inspection');
    }

    public function replicate(AuthUser $authUser, Inspection $inspection): bool
    {
        return $authUser->can('Replicate:Inspection');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Inspection');
    }

}