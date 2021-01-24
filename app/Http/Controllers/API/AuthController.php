<?php

namespace App\Http\Controllers\API;

use App\Contracts\AuthServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    /**
     * @var string
     */
    protected const GUARD = 'api';

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
     * Attempt access login user
     *
     * @param  LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     *
     * @OA\Post(
     *     path="/v1/auth/login",
     *     tags={"Authentication"},
     *     summary="Get access token for application",
     *     description="Return access token",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AuthRequest")
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
     *                          @OA\Property(property="data", ref="#/components/schemas/AuthResponse")
     *                      ),
     *                  }
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response=403,
     *          description="Credential not match",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  allOf={
     *                      @OA\Schema(ref="#/components/schemas/Wrapper"),
     *                      @OA\Schema(
     *                          @OA\Property(property="data", ref="#/components/schemas/AuthRequest")
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
     *                          @OA\Property(property="data", ref="#/components/schemas/AuthRequest")
     *                      ),
     *                  }
     *              )
     *          )
     *     )
     * )
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data'    => ['access_token' => $this->service->login($request, self::GUARD)],
            'message' => __('auth.success')
        ]);
    }

    /**
     * Handle user logout from application
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Delete (
     *     path="/v1/auth/logout",
     *     tags={"Authentication"},
     *     summary="Logout from application",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *          response=200,
     *          description="Successful",
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
     *          response=401,
     *          description="Unauthorized",
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
     * )
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        $this->service->logout(self::GUARD);

        return response()->json([
            'data'    => null,
            'message' => __('auth.logout')
        ]);
    }
}
