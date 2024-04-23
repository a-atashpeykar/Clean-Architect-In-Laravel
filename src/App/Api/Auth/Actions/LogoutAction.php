<?php

namespace App\Api\Auth\Actions;

use Illuminate\Http\RedirectResponse;

class LogoutAction
{
    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('home');
    }
}
