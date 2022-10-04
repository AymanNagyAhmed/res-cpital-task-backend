<?php

namespace App\Policies;

use App\Models\AdvertisingCampaign;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertisingCampaignPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdvertisingCampaign  $advertisingCampaign
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AdvertisingCampaign $advertisingCampaign)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdvertisingCampaign  $advertisingCampaign
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AdvertisingCampaign $advertisingCampaign)
    {
        return $user == $advertisingCampaign->owner;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdvertisingCampaign  $advertisingCampaign
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AdvertisingCampaign $advertisingCampaign)
    {
        return $user->id == $advertisingCampaign->owner->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdvertisingCampaign  $advertisingCampaign
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AdvertisingCampaign $advertisingCampaign)
    {
        return $user == $advertisingCampaign->owner;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdvertisingCampaign  $advertisingCampaign
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AdvertisingCampaign $advertisingCampaign)
    {
        return $user == $advertisingCampaign->owner;
    }
}
