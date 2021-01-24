<?php

namespace App\Supports\Virtual\Model;
/**
 * @OA\Schema(
 *     title="User Detail Response",
 *     description="User detail response model",
 *     @OA\Xml(
 *         name="UserDetailResponse"
 *     )
 * )
 */
class UserDetailResponse
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID of user detail",
     *     format="int",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $id;

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
