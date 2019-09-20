<?php

namespace Statamic\Actions;

use Statamic\Facades\User;

class SendActivationEmail extends Action
{
    public function visibleTo($key, $context)
    {
        return $key === 'users';
    }

    public function authorize($user)
    {
        return User::current()->can('sendActivationEmail', $user);
    }

    public function run($users)
    {
        $users->each->generateTokenAndSendPasswordResetNotification();
    }
}