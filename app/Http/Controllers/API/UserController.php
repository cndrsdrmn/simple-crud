<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\SimpleCrudService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var SimpleCrudService
     */
    protected SimpleCrudService $service;

    /**
     * UserController constructor.
     *
     * @param SimpleCrudService $service
     * @return void
     */
    public function __construct(SimpleCrudService $service)
    {
        $this->service = $service;
    }

    /**
     * Get resource of detail user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="/v1/user",
     *     tags={"Simple CRUD"},
     *     summary="Get resources",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          name="search",
     *          description="Keywords of search",
     *          in="query",
     *          @OA\Schema (type="string")
     *     ),
     *     @OA\Parameter(
     *          name="page",
     *          description="Number of page",
     *          in="query",
     *          @OA\Schema (type="integer")
     *     ),
     *     @OA\Parameter(
     *          name="status",
     *          description="Filter by status",
     *          in="query",
     *          @OA\Schema (type="string", enum={"active", "inactive"})
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  allOf={
     *                      @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                      @OA\Schema(
     *                          @OA\Property(property="pagination", ref="#/components/schemas/Pagination")
     *                      ),
     *                      @OA\Schema(
     *                          @OA\Property(
     *                              property="data",
     *                              type="array",
     *                              @OA\Items (
     *                                  allOf={
     *                                      @OA\Schema (ref="#/components/schemas/UserDetailResponse"),
     *                                      @OA\Schema (
     *                                          allOf={
     *                                              @OA\Schema (@OA\Property (property="user", ref="#/components/schemas/UserResponse"))
     *                                          }
     *                                      )
     *                                  },
     *                              )
     *                          )
     *                      ),
     *                  }
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  allOf={
     *                      @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                      @OA\Schema(
     *                          @OA\Property(property="data", example="null")
     *                      ),
     *                  }
     *              )
     *          )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $resource = $this->service->all($request);

        return response()->json(
            array_merge($resource, [
                    'message' => __('crud.index'),
                ]
            )
        );
    }

    /**
     * Get resource specific by id
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     *
     * @OA\Get(
     *     path="/v1/user/detail/{id}",
     *     tags={"Simple CRUD"},
     *     summary="Get resources specific by id",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          name="id",
     *          description="ID of user detail",
     *          in="path",
     *          required=true,
     *          @OA\Schema (type="integer")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              allOf={
     *                  @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                  @OA\Schema(
     *                      @OA\Property(
     *                          allOf={
     *                             @OA\Schema(ref="#/components/schemas/UserDetailResponse"),
     *                             @OA\Schema (
     *                                  allOf={
     *                                      @OA\Schema (@OA\Property (property="user", ref="#/components/schemas/UserResponse"))
     *                                  }
     *                             )
     *                          },
     *                          property="data"
     *                      )
     *                  ),
     *              }
     *          )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  allOf={
     *                      @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                      @OA\Schema(
     *                          @OA\Property(property="data", example="null")
     *                      ),
     *                  }
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Record not found",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  allOf={
     *                      @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                      @OA\Schema(
     *                          @OA\Property(property="data", example="null")
     *                      ),
     *                  }
     *              )
     *          )
     *     )
     * )
     */
    public function show(int $id)
    {
        return response()->json([
            'data'    => $this->service->show($id),
            'message' => __('crud.show')
        ]);
    }

    /**
     * @OA\Put (
     *     path="/v1/user/upsert",
     *     tags={"Simple CRUD"},
     *     summary="Create new resource",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserDetailRequest")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              allOf={
     *                  @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                  @OA\Schema(
     *                      @OA\Property(property="data", example="null")
     *                  ),
     *              }
     *          )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  allOf={
     *                      @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                      @OA\Schema(
     *                          @OA\Property(property="data", example="null")
     *                      ),
     *                  }
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Error validation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  allOf={
     *                      @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                      @OA\Schema(
     *                          @OA\Property(property="data", ref="#/components/schemas/UserDetailRequest")
     *                      ),
     *                  }
     *              )
     *          )
     *     )
     * )
     */

    /**
     * Handle store or update
     *
     * @param UserRequest $request
     * @param int|null $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Put (
     *     path="/v1/user/upsert/{id}",
     *     tags={"Simple CRUD"},
     *     summary="Update resource specific by id",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          name="id",
     *          description="ID of user detail",
     *          in="path",
     *          required=true,
     *          @OA\Schema (type="integer")
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserDetailRequest")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              allOf={
     *                  @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                  @OA\Schema(
     *                      @OA\Property(property="data", example="null")
     *                  ),
     *              }
     *          )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  allOf={
     *                      @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                      @OA\Schema(
     *                          @OA\Property(property="data", example="null")
     *                      ),
     *                  }
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Error validation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  allOf={
     *                      @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                      @OA\Schema(
     *                          @OA\Property(property="data", ref="#/components/schemas/UserDetailRequest")
     *                      ),
     *                  }
     *              )
     *          )
     *     )
     * )
     */
    public function upsert(UserRequest $request, int $id = null)
    {
        $this->service->upsert($request, $id);

        return response()->json([
            'data'    => null,
            'message' => __('crud.upsert')
        ]);
    }

    /**
     * Remove resource specific by id
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     * @throws \Throwable
     *
     * @OA\Delete (
     *     path="/v1/user/remove/{id}",
     *     tags={"Simple CRUD"},
     *     summary="Remove resources specific by id",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *          name="id",
     *          description="If you fill this segment that action is update, then if you not fill that action is store",
     *          in="path",
     *          required=true,
     *          @OA\Schema (type="integer")
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              allOf={
     *                  @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                  @OA\Schema(
     *                      @OA\Property(property="data", example="null")
     *                  ),
     *              }
     *          )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  allOf={
     *                      @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                      @OA\Schema(
     *                          @OA\Property(property="data", example="null")
     *                      ),
     *                  }
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response=404,
     *          description="Record not found",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  allOf={
     *                      @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                      @OA\Schema(
     *                          @OA\Property(property="data", example="null")
     *                      ),
     *                  }
     *              )
     *          )
     *     )
     * )
     */
    public function destroy(int $id)
    {
        $this->service->destroy($id);

        return response()->json([
            'data'    => null,
            'message' => __('crud.delete')
        ]);
    }
}
