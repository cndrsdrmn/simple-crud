<?php

namespace App\Contracts;

interface AuthServiceInterface
{
    /**
     * Attempt access login user
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $guard
     * @return mixed
     *
     * @throws \Throwable
     */
    public function login(\Illuminate\Http\Request $request, string $guard);

    /**
     * Handle user logout from application
     *
     * @param  string $guard
     * @return void
     */
    public function logout(string $guard): void;
}
