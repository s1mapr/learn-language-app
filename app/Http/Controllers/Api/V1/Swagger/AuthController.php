<?php

namespace App\Http\Controllers\Api\V1\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Post(
 *     path="/api/v1/auth/register",
 *     summary="Register users",
 *     tags={"Auth"},
 *
 *
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                      @OA\Property(property="name", type="string", example="Maksym"),
 *                      @OA\Property(property="surname", type="string", example="Prokopenko"),
 *                      @OA\Property(property="email", type="string", example="MaksymProkopenko@gmail.com"),
 *                      @OA\Property(property="password", type="string", example="password"),
 *                 )
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *      response=200,
 *      description="Request successful",
 *      @OA\JsonContent(
 *          @OA\Property(property="status", type="string", example="Request successful"),
 *          @OA\Property(property="message", type="string", nullable=true),
 *          @OA\Property(
 *              property="data",
 *              type="object",
 *              @OA\Property(
 *                  property="user",
 *                  type="object",
 *                  @OA\Property(property="id", type="integer", example=1),
 *                  @OA\Property(property="email", type="string", example="MaksymProkopenko@gmail.com"),
 *                  @OA\Property(property="name", type="string", example="Maksym"),
 *                  @OA\Property(property="surname", type="string", example="Prokopenko")
 *              ),
 *              @OA\Property(property="token", type="string", example="4|c6u23dX8dk3A4lxDQpdfO4oNclfbneljphpw5xZN9c1728e7")
 *          )
 *      )
 *  )
 *
 * ),
 *
 * @OA\Post(
 *       path="/api/v1/auth/login",
 *       summary="Login for users",
 *       tags={"Auth"},
 *
 *       @OA\RequestBody(
 *           @OA\JsonContent(
 *               allOf={
 *                   @OA\Schema(
 *                        @OA\Property(property="email", type="string", example="MaksymProkopenko@gmail.com"),
 *                        @OA\Property(property="password", type="string", example="password"),
 *                   )
 *               }
 *           )
 *       ),
 *
 *       @OA\Response(
 *       response=200,
 *       description="Request successful",
 *       @OA\JsonContent(
 *           @OA\Property(property="status", type="string", example="Request successful"),
 *           @OA\Property(property="message", type="string", nullable=true),
 *           @OA\Property(
 *               property="data",
 *               type="object",
 *               @OA\Property(
 *                   property="user",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="email", type="string", example="MaksymProkopenko@gmail.com"),
 *                   @OA\Property(property="name", type="string", example="Maksym"),
 *                   @OA\Property(property="surname", type="string", example="Prokopenko")
 *               ),
 *              @OA\Property(property="token", type="string", example="4|c6u23dX8dk3A4lxDQpdfO4oNclfbneljphpw5xZN9c1728e7")
 *           )
 *       )
 *   )
 *
 *  ),*
 * @OA\Post(
 *       path="/api/v1/auth/admin-login",
 *       summary="Login for admins",
 *       tags={"Auth"},
 *
 *       @OA\RequestBody(
 *           @OA\JsonContent(
 *               allOf={
 *                   @OA\Schema(
 *                        @OA\Property(property="email", type="string", example="admin@admin.com"),
 *                        @OA\Property(property="password", type="string", example="password"),
 *                   )
 *               }
 *           )
 *       ),
 *
 *       @OA\Response(
 *       response=200,
 *       description="Request successful",
 *       @OA\JsonContent(
 *           @OA\Property(property="status", type="string", example="Request successful"),
 *           @OA\Property(property="message", type="string", nullable=true),
 *           @OA\Property(
 *               property="data",
 *               type="object",
 *               @OA\Property(
 *                   property="user",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="email", type="string", example="MaksymProkopenko@gmail.com"),
 *               ),
 *              @OA\Property(property="token", type="string", example="4|c6u23dX8dk3A4lxDQpdfO4oNclfbneljphpw5xZN9c1728e7")
 *           )
 *       )
 *   )
 *
 *  ),
 *
 *
 * */
class AuthController extends Controller
{

}
