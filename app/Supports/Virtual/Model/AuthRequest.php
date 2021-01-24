<?php

namespace App\Supports\Virtual\Model;

/**
 * @OA\Schema(
 *     title="Authentication Request",
 *     description="AuthResponse request model",
 *     @OA\Xml(
 *         name="AuthRequest"
 *     )
 * )
 */
class AuthRequest
{
    /**
     * @OA\Property(
     *     title="email",
     *     description="email address",
     *     format="string",
     *     example="user@test.com"
     * )
     *
     * @var string
     */
    public string $email;

    /**
     * @OA\Property(
     *     title="password",
     *     description="password",
     *     format="string",
     *     example="password"
     * )
     *
     * @var string
     */
    public string $password;
}
