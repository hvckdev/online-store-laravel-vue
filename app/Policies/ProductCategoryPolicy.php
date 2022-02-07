<?php

namespace App\Policies;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProductCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('edit-categories');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param ProductCategory $productCategory
     * @return bool
     */
    public function view(User $user, ProductCategory $productCategory): bool
    {
        return $user->can('edit-categories');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('edit-categories');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param ProductCategory $productCategory
     * @return bool
     */
    public function update(User $user, ProductCategory $productCategory): bool
    {
        return $user->can('edit-categories');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param ProductCategory $productCategory
     * @return bool
     */
    public function delete(User $user, ProductCategory $productCategory): bool
    {
        return $user->can('edit-categories');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param ProductCategory $productCategory
     * @return bool
     */
    public function restore(User $user, ProductCategory $productCategory): bool
    {
        return $user->can('edit-categories');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param ProductCategory $productCategory
     * @return bool
     */
    public function forceDelete(User $user, ProductCategory $productCategory): bool
    {
        return $user->can('edit-categories');
    }
}
