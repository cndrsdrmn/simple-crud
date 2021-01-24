<?php

namespace App\Supports\Virtual\Model;

/**
 * @OA\Schema(
 *     title="Authentication",
 *     description="AuthResponse model",
 *     @OA\Xml(
 *         name="AuthResponse"
 *     )
 * )
 */
class AuthResponse
{
    /**
     * @OA\Property(
     *     title="access_token",
     *     description="access token",
     *     format="string",
     *     example="asdasdasdsadasd"
     * )
     *
     * @var string
     */
    public string $accessToken;
}
