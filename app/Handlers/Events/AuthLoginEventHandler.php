<?php

namespace Proto\Handlers\Events;

use Proto\Models\Committee;
use Proto\Models\Role;
use Proto\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuthLoginEventHandler
{
    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Events $event
     * @return void
     */
    public function handle(User $user, $remember)
    {
        // We will grant the user all roles to which he is entitled!
        $rootcommittee = Committee::where('slug', config('proto.rootcommittee'))->first();
        $boardcommittee = Committee::where('slug', config('proto.boardcommittee'))->first();
        $omnomcom = Committee::where('slug', config('proto.omnomcom'))->first();

        if($user->isInCommittee($rootcommittee)) {
            if (!$user->hasRole('admin')) {
                $user->attachRole(Role::where('name', '=', 'admin')->first());
            }
        } else {
            if ($user->hasRole('admin')) {
                $user->detachRole(Role::where('name', '=', 'admin')->first());
            }
        }

        if($user->isInCommittee($boardcommittee)) {
            if (!$user->hasRole('board')) {
                $user->attachRole(Role::where('name', '=', 'board')->first());
            }
        } else {
            if ($user->hasRole('board')) {
                $user->detachRole(Role::where('name', '=', 'board')->first());
            }
        }

        if($user->isInCommittee($omnomcom)) {
            if (!$user->hasRole('omnomcom')) {
                $user->attachRole(Role::where('name', '=', 'omnomcom')->first());
            }
        } else {
            if ($user->hasRole('omnomcom')) {
                $user->detachRole(Role::where('name', '=', 'omnomcom')->first());
            }
        }
    }
}
