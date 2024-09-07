<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

class IndexController
{
    public function __invoke()
    {
        return inertia('Auth/Login');
    }
}