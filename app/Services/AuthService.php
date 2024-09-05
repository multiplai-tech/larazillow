<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService {
	public function store(array $data)
    {
		dd('from service');
        // if (!Auth::attempt($request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string'
        // ]), true)) {
        //     throw ValidationException::withMessages([
        //         'email' => 'Authentication failed'
        //     ]);
        // }

        // $request->session()->regenerate();

        // return redirect()->intended('/listing');
    }
}