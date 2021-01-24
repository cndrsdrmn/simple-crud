<?php

namespace App\Supports\Virtual\Model;

/**
 * @OA\Schema(
 *     title="Pagination Wrapper",
 *     description="Pagination model",
 *     @OA\Xml(
 *         name="Pagination"
 *     )
 * )
 */
class Pagination
{
    /**
     * @OA\Property(
     *     property="current_page",
     *     title="current page",
     *     description="Show current page number",
     *     format="integer",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $currentPage;

    /**
     * @OA\Property(
     *     property="first_page_url",
     *     title="show first page url",
     *     description="Show first page url",
     *     format="string",
     *     example="http://localhost:8000/api/v1/user?page=1"
     * )
     *
     * @var string
     */
    public string $firstPageUrl;

    /**
     * @OA\Property(
     *     property="from",
     *     title="show start item from",
     *     description="Show start item from",
     *     format="integer",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $from;

    /**
     * @OA\Property(
     *     property="last_page",
     *     title="show last page",
     *     description="Show last page",
     *     format="integer",
     *     example="1"
     * )
     *
     * @var int
     */
    public int $lastPage;

    /**
     * @OA\Property(
     *     property="last_page_url",
     *     title="show last page url",
     *     description="Show last page url",
     *     format="string",
     *     example="http://localhost:8000/api/v1/user?page=1"
     * )
     *
     * @var string
     */
    public string $lastPageUrl;

    /**
     * @OA\Property(
     *     property="next_page_url",
     *     title="show next page url",
     *     description="Show next page url",
     *     format="string",
     *     example="null"
     * )
     *
     * @var string
     */
    public string $nextPageUrl;

    /**
     * @OA\Property(
     *     property="path",
     *     title="show path page url",
     *     description="Show path page url",
     *     format="string",
     *     example="http://localhost:8000/api/v1/user"
     * )
     *
     * @var string
     */
    public string $path;

    /**
     * @OA\Property(
     *     property="per_page",
     *     title="show per page",
     *     description="Show per page",
     *     format="integer",
     *     example="15"
     * )
     *
     * @var int
     */
    public int $perPage;

    /**
     * @OA\Property(
     *     property="prev_page_url",
     *     title="show previous page url",
     *     description="Show previous page url",
     *     format="string",
     *     example="null"
     * )
     *
     * @var string
     */
    public string $prevPageUrl;

    /**
     * @OA\Property(
     *     property="to",
     *     title="show last item number of current page",
     *     description="Show last item number of current page",
     *     format="integer",
     *     example="13"
     * )
     *
     * @var int
     */
    public int $to;

    /**
     * @OA\Property(
     *     property="total",
     *     title="show total item",
     *     description="Show total item",
     *     format="integer",
     *     example="13"
     * )
     *
     * @var string
     */
    public string $total;
}
