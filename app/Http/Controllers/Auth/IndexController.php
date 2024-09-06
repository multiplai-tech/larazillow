<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

class IndexController
{
    public function __invoke()
    {
        return inertia('Auth/Login');
    }
}