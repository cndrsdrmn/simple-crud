<?php

namespace App\Supports\Virtual\Model;
/**
 * @OA\Schema(
 *     title="User Detail Request",
 *     description="User detail request model",
 *     @OA\Xml(
 *         name="UserDetailRequest"
 *     )
 * )
 */
class UserDetailRequest
{
    /**
     * @OA\Property(
     *     property="user_id",
     *     title="user_id",
     *     description="ID of user",
     *     format="int",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $userId;

    /**
     * @OA\Property(
     *     title="status",
     *     description="Status of user detail",
     *     format="string",
     *     example="active"
     * )
     *
     * @var string
     */
    public string $status;

    /**
     * @OA\Property(
     *     title="position",
     *     description="Position of user detail",
     *     format="string",
     *     example="Web Programmer"
     * )
     *
     * @var string
     */
    public string $position;
}
