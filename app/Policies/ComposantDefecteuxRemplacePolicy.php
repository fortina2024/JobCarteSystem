<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ComposantDefecteuxRemplace;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComposantDefecteuxRemplacePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ComposantDefecteuxRemplace');
    }

    public function view(AuthUser $authUser, ComposantDefecteuxRemplace $composantDefecteuxRemplace): bool
    {
        return $authUser->can('View:ComposantDefecteuxRemplace');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ComposantDefecteuxRemplace');
    }

    public function update(AuthUser $authUser, ComposantDefecteuxRemplace $composantDefecteuxRemplace): bool
    {
        return $authUser->can('Update:ComposantDefecteuxRemplace');
    }

    public function delete(AuthUser $authUser, ComposantDefecteuxRemplace $composantDefecteuxRemplace): bool
    {
        return $authUser->can('Delete:ComposantDefecteuxRemplace');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ComposantDefecteuxRemplace');
    }

    public function restore(AuthUser $authUser, ComposantDefecteuxRemplace $composantDefecteuxRemplace): bool
    {
        return $authUser->can('Restore:ComposantDefecteuxRemplace');
    }

    public function forceDelete(AuthUser $authUser, ComposantDefecteuxRemplace $composantDefecteuxRemplace): bool
    {
        return $authUser->can('ForceDelete:ComposantDefecteuxRemplace');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ComposantDefecteuxRemplace');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ComposantDefecteuxRemplace');
    }

    public function replicate(AuthUser $authUser, ComposantDefecteuxRemplace $composantDefecteuxRemplace): bool
    {
        return $authUser->can('Replicate:ComposantDefecteuxRemplace');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ComposantDefecteuxRemplace');
    }

}