<?php

namespace App\Http\Controllers;

use App\Contracts\AuthServiceInterface;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var string
     */
    protected const GUARD = 'web';

    /**
     * @var AuthServiceInterface
     */
    protected AuthServiceInterface $service;

    /**
     * AuthController constructor.
     *
     * @param  AuthServiceInterface $service
     * @return void
     */
    public function __construct(AuthServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Get form login
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function formLogin()
    {
        return view('login');
    }

    /**
     * Attempt access login user
     *
     * @param  LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Throwable
     */
    public function login(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (! $this->service->login($request, self::GUARD)) {
            return redirect()->back()->withInput();
        }

        return redirect()->route('dashboard');
    }

    /**
     * Handle user logout from application
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->service->logout(self::GUARD);

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
