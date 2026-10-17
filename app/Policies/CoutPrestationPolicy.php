<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CoutPrestation;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoutPrestationPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CoutPrestation');
    }

    public function view(AuthUser $authUser, CoutPrestation $coutPrestation): bool
    {
        return $authUser->can('View:CoutPrestation');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CoutPrestation');
    }

    public function update(AuthUser $authUser, CoutPrestation $coutPrestation): bool
    {
        return $authUser->can('Update:CoutPrestation');
    }

    public function delete(AuthUser $authUser, CoutPrestation $coutPrestation): bool
    {
        return $authUser->can('Delete:CoutPrestation');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:CoutPrestation');
    }

    public function restore(AuthUser $authUser, CoutPrestation $coutPrestation): bool
    {
        return $authUser->can('Restore:CoutPrestation');
    }

    public function forceDelete(AuthUser $authUser, CoutPrestation $coutPrestation): bool
    {
        return $authUser->can('ForceDelete:CoutPrestation');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CoutPrestation');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CoutPrestation');
    }

    public function replicate(AuthUser $authUser, CoutPrestation $coutPrestation): bool
    {
        return $authUser->can('Replicate:CoutPrestation');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CoutPrestation');
    }

}