<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

class CreateController
{
    public function __invoke()
    {
        return inertia('Auth/Login');
    }
}