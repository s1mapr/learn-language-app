<?php

namespace App\Http\Controllers\Api\V1\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Get(
 *     path="/api/v1/users",
 *     summary="Get all users (Route only for admins)",
 *     tags={"User"},
 *     security={{"sanctum": {}}},
 *
 *     @OA\Parameter(
 *          name="page",
 *          in="query",
 *          description="Page number",
 *          required=false,
 *          @OA\Schema(
 *              type="integer",
 *          )
 *      ),
 *      @OA\Parameter(
 *          name="query",
 *          in="query",
 *          description="Query for searching particular user by email",
 *          required=false,
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
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
 *              @OA\Property(property="currentPage", type="integer", example=1),
 *              @OA\Property(property="lastPage", type="integer", example=1),
 *              @OA\Property(property="size", type="integer", example=2),
 *              @OA\Property(
 *                  property="users",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Property(property="id", type="integer", example=1),
 *                      @OA\Property(property="email", type="string", example="MaksymProkopenko@gmail.com"),
 *                      @OA\Property(property="name", type="string", example="Maksym"),
 *                      @OA\Property(property="surname", type="string", example="Prokopenko"),
 *                      @OA\Property(property="isBlocked", type="boolean", example="0"),
 *                  ),
 *              ),
 *          )
 *      )
 *  )
 *
 * ),
 *
 *
 * @OA\Get(
 *      path="/api/v1/users/{id} (Route only for users)",
 *      summary="Get user by id",
 *      tags={"User"},
 *      security={{"sanctum": {}}},
 *
 *      @OA\Parameter(
 *           name="id",
 *           in="path",
 *           description="id of user",
 *           required=true,
 *           example=1,
 *           @OA\Schema(
 *               type="integer",
 *           )
 *       ),
 *
 *
 *      @OA\Response(
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
 *          )
 *      )
 *  )
 *
 * ),
 *
 * @OA\Get(
 *      path="/api/v1/users/collections",
 *      summary="Get all user collections",
 *      tags={"User"},
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
 *           description="Query for searching collections by name",
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
 *                   property="data",
 *                   type="array",
 *                   @OA\Items(
 *                       @OA\Property(property="id", type="integer", example=1),
 *                       @OA\Property(property="name", type="string", example="Tourism"),
 *                       @OA\Property(property="text", type="string", example="Discover the enchanting beauty of Italy's Amalfi Coast. With its picturesque cliffside villages, azure waters, and vibrant culture, the Amalfi Coast offers an unforgettable travel experience. Whether you're exploring the historic streets of Positano, indulging in delicious Mediterranean cuisine, or lounging on pristine beaches, every moment is a postcard-worthy memory waiting to be captured."),
 *                       @OA\Property(property="translationUk", type="string", example="Відкрийте для себе чарівну красу узбережжя Амальфі в Італії. З його мальовничими селами на скелях, блакитними водами та яскравою культурою узбережжя Амальфі пропонує незабутні враження від подорожей. Якщо ви досліджуєте історичні вулиці Позітано, смакуєте смачні страви середземноморської кухні чи відпочиваєте на незайманих пляжах, кожна мить — це пам’ять, гідна листівки, яка чекає, щоб її зафіксувати."),
 *                       @OA\Property(property="status", type="string", example="public"),
 *                       @OA\Property(property="posterUrl", type="string", example="https://images-cdn.ubuy.co.in/633ff1157e3fbc25557517c8-one-piece-poster-japanese-anime-posters.jpg"),
 *                       @OA\Property(property="bannerUrl", type="string", example="https://i.pinimg.com/736x/00/a7/81/00a781cc93f26bc0b753e18b240673e2.jpg"),
 *                       @OA\Property(property="likes", type="integer", example="100"),
 *                       @OA\Property(property="views", type="integer", example="2266"),
 *                       @OA\Property(property="wordsCount", type="integer", example="41"),
 *                       @OA\Property(property="wordsLearned", type="integer", example="25"),
 *                       @OA\Property(property="isStarted", type="boolean", example="0"),
 *                       @OA\Property(property="isLiked", type="boolean", example="0"),
 *                   ),
 *               ),
 *           )
 *       )
 *   )
 *
 *  ),
 *
 * @OA\Patch(
 *      path="/api/v1/users/{id}",
 *      summary="Update user data",
 *      tags={"User"},
 *      security={{"sanctum": {}}},
 *      @OA\Parameter(
 *            name="id",
 *            in="path",
 *            description="id of user",
 *            required=true,
 *            example=1,
 *            @OA\Schema(
 *                type="integer",
 *            )
 *      ),
 *      @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                       @OA\Property(property="name", type="string", example="Maksym"),
 *                       @OA\Property(property="surname", type="string", example="Prokopenko"),
 *                       @OA\Property(property="password", type="string", example="password"),
 *                  )
 *              }
 *          )
 *      ),
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
 *               @OA\Property(
 *                   property="user",
 *                   type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="email", type="string", example="MaksymProkopenko@gmail.com"),
 *                   @OA\Property(property="name", type="string", example="Maksym"),
 *                   @OA\Property(property="surname", type="string", example="Prokopenko")
 *               ),
 *           )
 *       )
 *   )
 *
 *  ),
 *
 * @OA\Patch(
 *      path="/api/v1/users/{id}/blockOrUnblock",
 *      summary="Block or unblock user",
 *      tags={"User"},
 *      security={{"sanctum": {}}},
 *      @OA\Parameter(
 *            name="id",
 *            in="path",
 *            description="id of user",
 *            required=true,
 *            example=1,
 *            @OA\Schema(
 *                type="integer",
 *            )
 *      ),
 *
 *      @OA\Response(
 *       response=200,
 *       description="Request successful",
 *       @OA\JsonContent(
 *           @OA\Property(property="status", type="string", example="Request successful"),
 *           @OA\Property(property="message", type="string", example="user status successfully changed"),
 *           @OA\Property(property="data", type="object", example="")
 *       )
 *   )
 *
 *  ),
 *
 * @OA\Patch(
 *      path="/api/v1/users/like/{id}",
 *      summary="like collection (route only for users)",
 *      tags={"User"},
 *      security={{"sanctum": {}}},
 *      @OA\Parameter(
 *            name="id",
 *            in="path",
 *            description="id of collection",
 *            required=true,
 *            example=1,
 *            @OA\Schema(
 *                type="integer",
 *            )
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="Request successful",
 *          @OA\JsonContent(
 *              @OA\Property(property="status", type="string", example="Request successful"),
 *              @OA\Property(property="message", type="string", example="success"),
 *              @OA\Property(property="data", type="object", example="")
 *          )
 *      )
 *
 *  ),
 *
 *
 * @OA\Post(
 *      path="/api/v1/users/startCollection/{id}",
 *      summary="User start learning collection (Route only for users)",
 *      tags={"User"},
 *      security={{"sanctum": {}}},
 *
 *     @OA\Parameter(
 *             name="id",
 *             in="path",
 *             description="id of collection",
 *             required=true,
 *             example=1,
 *             @OA\Schema(
 *                 type="integer",
 *             )
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
 *               type="array",
 *               @OA\Items(
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="name", type="string", example="Tourism"),
 *                   @OA\Property(property="text", type="string", example="Discover the enchanting beauty of Italy's Amalfi Coast. With its picturesque cliffside villages, azure waters, and vibrant culture, the Amalfi Coast offers an unforgettable travel experience. Whether you're exploring the historic streets of Positano, indulging in delicious Mediterranean cuisine, or lounging on pristine beaches, every moment is a postcard-worthy memory waiting to be captured."),
 *                   @OA\Property(property="translationUk", type="string", example="Відкрийте для себе чарівну красу узбережжя Амальфі в Італії. З його мальовничими селами на скелях, блакитними водами та яскравою культурою узбережжя Амальфі пропонує незабутні враження від подорожей. Якщо ви досліджуєте історичні вулиці Позітано, смакуєте смачні страви середземноморської кухні чи відпочиваєте на незайманих пляжах, кожна мить — це пам’ять, гідна листівки, яка чекає, щоб її зафіксувати."),
 *                   @OA\Property(property="status", type="string", example="public"),
 *                   @OA\Property(property="posterUrl", type="string", example="https://images-cdn.ubuy.co.in/633ff1157e3fbc25557517c8-one-piece-poster-japanese-anime-posters.jpg"),
 *                   @OA\Property(property="bannerUrl", type="string", example="https://i.pinimg.com/736x/00/a7/81/00a781cc93f26bc0b753e18b240673e2.jpg"),
 *                   @OA\Property(property="likes", type="integer", example="100"),
 *                   @OA\Property(property="views", type="integer", example="2266"),
 *                   @OA\Property(property="wordsCount", type="integer", example="41"),
 *                   @OA\Property(property="wordsLearned", type="integer", example="25"),
 *                   @OA\Property(property="isStarted", type="boolean", example="0"),
 *                   @OA\Property(property="isLiked", type="boolean", example="0"),
 *               ),
 *            )
 *       )
 *   )
 *
 *  ),
 *
 **/
class UserController extends Controller
{

}
