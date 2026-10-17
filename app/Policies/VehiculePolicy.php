<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Vehicule;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiculePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Vehicule');
    }

    public function view(AuthUser $authUser, Vehicule $vehicule): bool
    {
        return $authUser->can('View:Vehicule');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Vehicule');
    }

    public function update(AuthUser $authUser, Vehicule $vehicule): bool
    {
        return $authUser->can('Update:Vehicule');
    }

    public function delete(AuthUser $authUser, Vehicule $vehicule): bool
    {
        return $authUser->can('Delete:Vehicule');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Vehicule');
    }

    public function restore(AuthUser $authUser, Vehicule $vehicule): bool
    {
        return $authUser->can('Restore:Vehicule');
    }

    public function forceDelete(AuthUser $authUser, Vehicule $vehicule): bool
    {
        return $authUser->can('ForceDelete:Vehicule');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Vehicule');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Vehicule');
    }

    public function replicate(AuthUser $authUser, Vehicule $vehicule): bool
    {
        return $authUser->can('Replicate:Vehicule');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Vehicule');
    }

}