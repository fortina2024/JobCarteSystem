<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TempsSupplementaire;
use Illuminate\Auth\Access\HandlesAuthorization;

class TempsSupplementairePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TempsSupplementaire');
    }

    public function view(AuthUser $authUser, TempsSupplementaire $tempsSupplementaire): bool
    {
        return $authUser->can('View:TempsSupplementaire');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TempsSupplementaire');
    }

    public function update(AuthUser $authUser, TempsSupplementaire $tempsSupplementaire): bool
    {
        return $authUser->can('Update:TempsSupplementaire');
    }

    public function delete(AuthUser $authUser, TempsSupplementaire $tempsSupplementaire): bool
    {
        return $authUser->can('Delete:TempsSupplementaire');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:TempsSupplementaire');
    }

    public function restore(AuthUser $authUser, TempsSupplementaire $tempsSupplementaire): bool
    {
        return $authUser->can('Restore:TempsSupplementaire');
    }

    public function forceDelete(AuthUser $authUser, TempsSupplementaire $tempsSupplementaire): bool
    {
        return $authUser->can('ForceDelete:TempsSupplementaire');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TempsSupplementaire');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TempsSupplementaire');
    }

    public function replicate(AuthUser $authUser, TempsSupplementaire $tempsSupplementaire): bool
    {
        return $authUser->can('Replicate:TempsSupplementaire');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TempsSupplementaire');
    }

}