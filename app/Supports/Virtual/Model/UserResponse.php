<?php

namespace App\Supports\Virtual\Model;
/**
 * @OA\Schema(
 *     title="User Response",
 *     description="User response model",
 *     @OA\Xml(
 *         name="UserResponse"
 *     )
 * )
 */
class UserResponse
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID of user",
     *     format="int",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $id;

    /**
     * @OA\Property(
     *     title="name",
     *     description="name of user",
     *     format="string",
     *     example="lorem ipsum"
     * )
     *
     * @var string
     */
    public string $name;

    /**
     * @OA\Property(
     *     title="email",
     *     description="Email address of user",
     *     format="string",
     *     example="loremipsum@mail.org"
     * )
     *
     * @var string
     */
    public string $email;
}
