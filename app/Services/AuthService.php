<?php

namespace App\Services;

use App\Contracts\AuthServiceInterface;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceInterface
{
    /**
     * @var Auth
     */
    protected Auth $auth;

    /**
     * AuthService constructor.
     *
     * @param  Auth $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * {@inheritdoc}
     */
    public function login(\Illuminate\Http\Request $request, string $guard)
    {
        $token = $this->auth->guard($guard)->attempt(
            $this->credentials($request)
        );

        throw_if(!$token, ValidationException::withMessages(['email' => __('auth.failed')])->status(403));

        return $token;
    }

    /**
     * {@inheritdoc}
     */
    public function logout(string $guard): void
    {
        $this->auth->guard($guard)->logout();
    }

    /**
     * Get credential for user
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(\Illuminate\Http\Request $request): array
    {
        return $request->only(['email', 'password']);
    }
}
