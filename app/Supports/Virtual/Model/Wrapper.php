<?php

namespace App\Supports\Virtual\Model;

/**
 * @OA\Schema(
 *     title="Wrapper Response",
 *     description="Wrapper Response",
 *     @OA\Xml(
 *         name="Wrapper"
 *     )
 * )
 */
class Wrapper
{
    /**
     * @OA\Property(
     *     title="data",
     *     description="Data",
     *     format="object"
     * )
     *
     * @var object
     */
    public object $data;

    /**
     * @OA\Property(
     *     title="message",
     *     description="message",
     *     format="string",
     *     example="message"
     * )
     *
     * @var string
     */
    public string $message;
}
