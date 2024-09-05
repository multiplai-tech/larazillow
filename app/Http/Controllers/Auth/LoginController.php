<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Request\V1\Auth\LoginRequest;

class LoginController
{
    public function __invoke(LoginRequest $request)
	{
		$request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended('/listing');
	}
}
