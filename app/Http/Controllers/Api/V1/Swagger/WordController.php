<?php

namespace App\Http\Controllers\Api\V1\Swagger;

use App\Http\Controllers\Controller;
/**
 * @OA\Get(
 *      path="/api/v1/words",
 *      summary="Get all words (Route only for admins)",
 *      tags={"Word"},
 *      security={{"sanctum": {}}},
 *
 *      @OA\Parameter(
 *           name="page",
 *           in="query",
 *           description="Page number",
 *           required=false,
 *           @OA\Schema(
 *               type="integer",
 *           )
 *       ),
 *       @OA\Parameter(
 *           name="query",
 *           in="query",
 *           description="Query for searching words by english meaning",
 *           required=false,
 *           @OA\Schema(
 *               type="string"
 *           )
 *       ),
 *
 *      @OA\Response(
 *       response=200,
 *       description="Request successful",
 *       @OA\JsonContent(
 *           @OA\Property(property="status", type="string", example="Request successful"),
 *           @OA\Property(property="message", type="string", nullable=true),
 *           @OA\Property(
 *               property="data",
 *               type="object",
 *               @OA\Property(property="currentPage", type="integer", example=1),
 *               @OA\Property(property="lastPage", type="integer", example=1),
 *               @OA\Property(property="size", type="integer", example=2),
 *               @OA\Property(
 *                   property="words",
 *                   type="array",
 *                   @OA\Items(
 *                       @OA\Property(property="id", type="integer", example=1),
 *                       @OA\Property(property="word", type="string", example="this"),
 *                       @OA\Property(property="translationUk", type="string", example="цей"),
 *                   ),
 *               ),
 *           )
 *       )
 *   )
 *
 *  ),
 *
 * @OA\Get(
 *       path="/api/v1/words/{id}",
 *       summary="Get word by id (Route only for admins)",
 *       tags={"Word"},
 *       security={{"sanctum": {}}},
 *
 *       @OA\Parameter(
 *            name="id",
 *            in="path",
 *            description="id of word",
 *            required=true,
 *            example=1,
 *            @OA\Schema(
 *                type="integer",
 *            )
 *        ),
 *
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
 *               @OA\Property(property="id", type="integer", example=1),
 *               @OA\Property(property="word", type="string", example="this"),
 *               @OA\Property(property="translationUk", type="string", example="цей"),
 *
 *           )
 *       )
 *   )
 *
 * ),
 *
 * @OA\Patch(
 *       path="/api/v1/words/{id}",
 *       summary="Update word",
 *       tags={"Word"},
 *       security={{"sanctum": {}}},
 *       @OA\Parameter(
 *             name="id",
 *             in="path",
 *             description="id of word",
 *             required=true,
 *             example=1,
 *             @OA\Schema(
 *                 type="integer",
 *             )
 *       ),
 *       @OA\RequestBody(
 *           @OA\JsonContent(
 *               allOf={
 *                   @OA\Schema(
 *                        @OA\Property(property="word", type="string", example="dog"),
 *                        @OA\Property(property="translationUk", type="string", example="собака"),
 *                   )
 *               }
 *           )
 *       ),
 *
 *       @OA\Response(
 *        response=200,
 *        description="Request successful",
 *        @OA\JsonContent(
 *            @OA\Property(property="status", type="string", example="Request successful"),
 *            @OA\Property(property="message", type="string", nullable=true),
 *            @OA\Property(
 *                property="data",
 *                type="object",
 *                @OA\Property(property="id", type="integer", example=1),
 *                @OA\Property(property="word", type="string", example="dog"),
 *                @OA\Property(property="translationUk", type="string", example="собака"),
 *                ),
 *            )
 *        )
 *    )
 *
 *   ),
 *
 *
 *
 */
class WordController extends Controller
{

}
