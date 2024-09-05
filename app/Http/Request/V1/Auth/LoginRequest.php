<?php

namespace App\Http\Request\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

	public function authenticate()
    {
        if (!Auth::attempt($this->only('email', 'password'), true)) {
            throw ValidationException::withMessages([
                'email' => 'Authentication failed'
            ]);
        }
    }
}
