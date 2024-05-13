<?php

namespace App\Http\Controllers\Api\V1\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Post(
 *      path="/api/v1/collections",
 *      summary="Create collection (Route only for users)",
 *      tags={"Word Collection"},
 *      security={{"sanctum": {}}},
 *
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      property="banner",
 *                      type="string",
 *                      format="binary",
 *                      description="Banner file"
 *                  ),
 *                  @OA\Property(
 *                      property="poster",
 *                      type="string",
 *                      format="binary",
 *                      description="Poster file"
 *                  ),
 *                  @OA\Property(
 *                      property="name",
 *                      type="string",
 *                      description="Name field"
 *                  ),
 *                  @OA\Property(
 *                      property="text",
 *                      type="string",
 *                      description="Text field"
 *                  ),
 *                  @OA\Property(
 *                      property="status",
 *                      type="string",
 *                      description="Status field (can be private/pending/public)"
 *                  ),
 *                  @OA\Property(
 *                      property="color",
 *                      type="string",
 *                      description="Color field (hex)"
 *                  ),
 *
 *              )
 *          )
 *      ),
 *
 *      @OA\Response(
 *        response=200,
 *        description="Request successful",
 *        @OA\JsonContent(
 *            @OA\Property(property="status", type="string", example="Request successful"),
 *            @OA\Property(property="message", type="string", nullable=true),
 *            @OA\Property(
 *                property="data",
 *                type="object",
 *                @OA\Property(property="id", type="integer", example=1),
 *                @OA\Property(property="name", type="string", example="Tourism"),
 *                @OA\Property(property="status", type="string", example="public"),
 *                @OA\Property(property="textId", type="integer", example=1),
 *                @OA\Property(property="posterUrl", type="string", example="https://empat-final-project-pictures.s3.amazonaws.com/public/posters/poster11.jpg"),
 *                @OA\Property(property="bannerUrl", type="string", example="https://empat-final-project-pictures.s3.amazonaws.com/public/banners/banner11.jpg"),
 *                @OA\Property(property="wordsCount", type="integer", example="41"),
 *                @OA\Property(property="wordsLearned", type="integer", example="25"),
 *                @OA\Property(property="isStarted", type="boolean", example="1"),
 *                @OA\Property(property="coloer", type="string", example="#FFFFFF"),
 *             )
 *        )
 *    )
 *  ),
 *
 * @OA\Post(
 *      path="/api/v1/collections/{id}/comment",
 *      summary="Create comments",
 *      tags={"Word Collection"},
 *      security={{"sanctum": {}}},
 *
 *     @OA\Parameter(
 *              name="id",
 *              in="path",
 *              description="id of user",
 *              required=true,
 *              example=1,
 *              @OA\Schema(
 *                  type="integer",
 *              )
 *        ),
 *
 *      @OA\RequestBody(
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                       @OA\Property(property="content", type="string", example="my first comment"),
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
 *               @OA\Property(property="id", type="integer", example=1),
 *               @OA\Property(property="content", type="string", example="my first comment"),
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
 * @OA\Get(
 *        path="/api/v1/collections",
 *        summary="Get all word collections (Route only for admins)",
 *        tags={"Word Collection"},
 *        security={{"sanctum": {}}},
 *
 *        @OA\Parameter(
 *             name="page",
 *             in="query",
 *             description="Page number",
 *             required=false,
 *             @OA\Schema(
 *                 type="integer",
 *             )
 *         ),
 *         @OA\Parameter(
 *             name="query",
 *             in="query",
 *             description="Query for searching collections by name",
 *             required=false,
 *             @OA\Schema(
 *                 type="string"
 *             )
 *         ),
 *
 *        @OA\Response(
 *         response=200,
 *         description="Request successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="Request successful"),
 *             @OA\Property(property="message", type="string", nullable=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="currentPage", type="integer", example=1),
 *                 @OA\Property(property="lastPage", type="integer", example=1),
 *                 @OA\Property(property="size", type="integer", example=2),
 *                 @OA\Property(
 *                     property="data",
 *                     type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="name", type="string", example="Tourism"),
 *                         @OA\Property(property="text", type="string", example="Discover the enchanting beauty of Italy's Amalfi Coast. With its picturesque cliffside villages, azure waters, and vibrant culture, the Amalfi Coast offers an unforgettable travel experience. Whether you're exploring the historic streets of Positano, indulging in delicious Mediterranean cuisine, or lounging on pristine beaches, every moment is a postcard-worthy memory waiting to be captured."),
 *                         @OA\Property(property="translationUk", type="string", example="Відкрийте для себе чарівну красу узбережжя Амальфі в Італії. З його мальовничими селами на скелях, блакитними водами та яскравою культурою узбережжя Амальфі пропонує незабутні враження від подорожей. Якщо ви досліджуєте історичні вулиці Позітано, смакуєте смачні страви середземноморської кухні чи відпочиваєте на незайманих пляжах, кожна мить — це пам’ять, гідна листівки, яка чекає, щоб її зафіксувати."),
 *                         @OA\Property(property="status", type="string", example="private"),
 *                         @OA\Property(property="userId", type="integer", example="1"),
 *                     ),
 *                 ),
 *             )
 *         )
 *     )
 *
 *    ),
 *
 * @OA\Get(
 *        path="/api/v1/collections/public",
 *        summary="Get public word collections",
 *        tags={"Word Collection"},
 *        security={{"sanctum": {}}},
 *
 *        @OA\Parameter(
 *             name="page",
 *             in="query",
 *             description="Page number",
 *             required=false,
 *             @OA\Schema(
 *                 type="integer",
 *             )
 *         ),
 *         @OA\Parameter(
 *             name="query",
 *             in="query",
 *             description="Query for searching collections by name",
 *             required=false,
 *             @OA\Schema(
 *                 type="string"
 *             )
 *         ),
 *
 *        @OA\Response(
 *         response=200,
 *         description="Request successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="Request successful"),
 *             @OA\Property(property="message", type="string", nullable=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="currentPage", type="integer", example=1),
 *                 @OA\Property(property="lastPage", type="integer", example=1),
 *                 @OA\Property(property="size", type="integer", example=2),
 *                 @OA\Property(
 *                     property="data",
 *                     type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="name", type="string", example="Tourism"),
 *                         @OA\Property(property="text", type="string", example="Discover the enchanting beauty of Italy's Amalfi Coast. With its picturesque cliffside villages, azure waters, and vibrant culture, the Amalfi Coast offers an unforgettable travel experience. Whether you're exploring the historic streets of Positano, indulging in delicious Mediterranean cuisine, or lounging on pristine beaches, every moment is a postcard-worthy memory waiting to be captured."),
 *                         @OA\Property(property="translationUk", type="string", example="Відкрийте для себе чарівну красу узбережжя Амальфі в Італії. З його мальовничими селами на скелях, блакитними водами та яскравою культурою узбережжя Амальфі пропонує незабутні враження від подорожей. Якщо ви досліджуєте історичні вулиці Позітано, смакуєте смачні страви середземноморської кухні чи відпочиваєте на незайманих пляжах, кожна мить — це пам’ять, гідна листівки, яка чекає, щоб її зафіксувати."),
 *                         @OA\Property(property="status", type="string", example="public"),
 *                         @OA\Property(property="posterUrl", type="string", example="https://images-cdn.ubuy.co.in/633ff1157e3fbc25557517c8-one-piece-poster-japanese-anime-posters.jpg"),
 *                         @OA\Property(property="bannerUrl", type="string", example="https://i.pinimg.com/736x/00/a7/81/00a781cc93f26bc0b753e18b240673e2.jpg"),
 *                         @OA\Property(property="likes", type="integer", example="100"),
 *                         @OA\Property(property="views", type="integer", example="2266"),
 *                         @OA\Property(property="wordsCount", type="integer", example="41"),
 *                         @OA\Property(property="wordsLearned", type="integer", example="25"),
 *                         @OA\Property(property="isStarted", type="boolean", example="0"),
 *                         @OA\Property(property="isLiked", type="boolean", example="0"),
 *                     ),
 *                 ),
 *             )
 *         )
 *     )
 *
 *    ),
 *
 * @OA\Get(
 *        path="/api/v1/collections/requests",
 *        summary="Get requests for publication",
 *        tags={"Word Collection"},
 *        security={{"sanctum": {}}},
 *
 *        @OA\Parameter(
 *             name="page",
 *             in="query",
 *             description="Page number",
 *             required=false,
 *             @OA\Schema(
 *                 type="integer",
 *             )
 *         ),
 *         @OA\Parameter(
 *             name="query",
 *             in="query",
 *             description="Query for searching collections by name",
 *             required=false,
 *             @OA\Schema(
 *                 type="string"
 *             )
 *         ),
 *
 *        @OA\Response(
 *         response=200,
 *         description="Request successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="Request successful"),
 *             @OA\Property(property="message", type="string", nullable=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="currentPage", type="integer", example=1),
 *                 @OA\Property(property="lastPage", type="integer", example=1),
 *                 @OA\Property(property="size", type="integer", example=2),
 *                 @OA\Property(
 *                     property="requests",
 *                     type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="name", type="string", example="Tourism"),
 *                         @OA\Property(property="text", type="string", example="Discover the enchanting beauty of Italy's Amalfi Coast. With its picturesque cliffside villages, azure waters, and vibrant culture, the Amalfi Coast offers an unforgettable travel experience. Whether you're exploring the historic streets of Positano, indulging in delicious Mediterranean cuisine, or lounging on pristine beaches, every moment is a postcard-worthy memory waiting to be captured."),
 *                         @OA\Property(property="translationUk", type="string", example="Відкрийте для себе чарівну красу узбережжя Амальфі в Італії. З його мальовничими селами на скелях, блакитними водами та яскравою культурою узбережжя Амальфі пропонує незабутні враження від подорожей. Якщо ви досліджуєте історичні вулиці Позітано, смакуєте смачні страви середземноморської кухні чи відпочиваєте на незайманих пляжах, кожна мить — це пам’ять, гідна листівки, яка чекає, щоб її зафіксувати."),
 *                         @OA\Property(property="status", type="string", example="public"),
 *                         @OA\Property(property="userId", type="integer", example="1"),
 *                     ),
 *                 ),
 *             )
 *         )
 *     )
 *
 *    ),
 *
 * @OA\Get(
 *        path="/api/v1/collections/{id}",
 *        summary="Get word collection by id",
 *        tags={"Word Collection"},
 *        security={{"sanctum": {}}},
 *
 *         @OA\Parameter(
 *             name="id",
 *             in="path",
 *             description="Id of collection",
 *             required=true,
 *             example=1,
 *             @OA\Schema(
 *                 type="integer"
 *             )
 *         ),
 *
 *        @OA\Response(
 *         response=200,
 *         description="Request successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="Request successful"),
 *             @OA\Property(property="message", type="string", nullable=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Tourism"),
 *                 @OA\Property(property="text", type="string", example="Discover the enchanting beauty of Italy's Amalfi Coast. With its picturesque cliffside villages, azure waters, and vibrant culture, the Amalfi Coast offers an unforgettable travel experience. Whether you're exploring the historic streets of Positano, indulging in delicious Mediterranean cuisine, or lounging on pristine beaches, every moment is a postcard-worthy memory waiting to be captured."),
 *                 @OA\Property(property="translationUk", type="string", example="Відкрийте для себе чарівну красу узбережжя Амальфі в Італії. З його мальовничими селами на скелях, блакитними водами та яскравою культурою узбережжя Амальфі пропонує незабутні враження від подорожей. Якщо ви досліджуєте історичні вулиці Позітано, смакуєте смачні страви середземноморської кухні чи відпочиваєте на незайманих пляжах, кожна мить — це пам’ять, гідна листівки, яка чекає, щоб її зафіксувати."),
 *                 @OA\Property(property="status", type="string", example="public"),
 *                 @OA\Property(property="posterUrl", type="string", example="https://images-cdn.ubuy.co.in/633ff1157e3fbc25557517c8-one-piece-poster-japanese-anime-posters.jpg"),
 *                 @OA\Property(property="bannerUrl", type="string", example="https://i.pinimg.com/736x/00/a7/81/00a781cc93f26bc0b753e18b240673e2.jpg"),
 *                 @OA\Property(property="likes", type="integer", example="100"),
 *                 @OA\Property(property="views", type="integer", example="2266"),
 *                 @OA\Property(property="wordsCount", type="integer", example="41"),
 *                 @OA\Property(property="wordsLearned", type="integer", example="25"),
 *                 @OA\Property(property="isStarted", type="boolean", example="0"),
 *                 @OA\Property(property="isLiked", type="boolean", example="0"),
 *              ),
 *             )
 *         )
 *     )
 *
 *    ),
 *
 *@OA\Get(
 *        path="/api/v1/collections/{id}/quiz",
 *        summary="Get quiz for collection (Route only for users)",
 *        tags={"Word Collection"},
 *        security={{"sanctum": {}}},
 *
 *         @OA\Parameter(
 *             name="id",
 *             in="path",
 *             description="Id of collection",
 *             required=true,
 *             example=1,
 *             @OA\Schema(
 *                 type="integer"
 *             )
 *         ),
 *
 *        @OA\Response(
 *         response=200,
 *         description="Request successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="Request successful"),
 *             @OA\Property(property="message", type="string", nullable=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="word", type="string", example="dog"),
 *                 @OA\Property(property="answers", type="array",
 *                     @OA\Items(
 *                         @OA\Property(property="id", type="integer", example=1),
 *                         @OA\Property(property="translation", type="string", example="собака"),
 *                         @OA\Property(property="isAnswer", type="boolean", example=true),
 *
 *                     ),
 *                 ),
 *
 *                 ),
 *              ),
 *             )
 *         )
 *     )
 *
 *    ),
 *
 *
 * @OA\Get(
 *        path="/api/v1/collections/{id}/flashCards",
 *        summary="Get flash cards for collection (Route only for users)",
 *        tags={"Word Collection"},
 *        security={{"sanctum": {}}},
 *
 *         @OA\Parameter(
 *             name="id",
 *             in="path",
 *             description="Id of collection",
 *             required=true,
 *             example=1,
 *             @OA\Schema(
 *                 type="integer"
 *             )
 *         ),
 *
 *        @OA\Response(
 *         response=200,
 *         description="Request successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="Request successful"),
 *             @OA\Property(property="message", type="string", nullable=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="word", type="string", example="dog"),
 *                 @OA\Property(property="translationUk", type="string", example="собака"),
 *
 *                 ),
 *              ),
 *             )
 *         )
 *     )
 *
 *    ),
 *
 * @OA\Get(
 *        path="/api/v1/collections/{id}/text",
 *        summary="Get text for collection (Route only for users)",
 *        tags={"Word Collection"},
 *        security={{"sanctum": {}}},
 *
 *         @OA\Parameter(
 *             name="id",
 *             in="path",
 *             description="Id of collection",
 *             required=true,
 *             example=1,
 *             @OA\Schema(
 *                 type="integer"
 *             )
 *         ),
 *
 *        @OA\Response(
 *         response=200,
 *         description="Request successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="Request successful"),
 *             @OA\Property(property="message", type="string", nullable=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="text", type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="text", type="string", example="Discover the enchanting beauty of Italy's Amalfi Coast. With its picturesque cliffside villages, azure waters, and vibrant culture, the Amalfi Coast offers an unforgettable travel experience. Whether you're exploring the historic streets of Positano, indulging in delicious Mediterranean cuisine, or lounging on pristine beaches, every moment is a postcard-worthy memory waiting to be captured."),
 *                     @OA\Property(property="translationUk", type="string", example="Відкрийте для себе чарівну красу узбережжя Амальфі в Італії. З його мальовничими селами на скелях, блакитними водами та яскравою культурою узбережжя Амальфі подарує незабутні враження від подорожей. Якщо ви досліджуєте історичні вулиці Позітано, смакуєте смачні страви середземноморської кухні чи відпочиваєте на незайманих пляжах, кожна мить — це пам’ять, гідна листівки, яка чекає, щоб її зафіксувати."),
 *     ),
 *     @OA\Property(property="words", type="array",
 *                    @OA\Items(
 *                        @OA\Property(property="id", type="integer", example=1),
 *                        @OA\Property(property="word", type="string", example="dog"),
 *                        @OA\Property(property="translationUk", type="string", example="собака"),
 *                    ),
 *                 ),
 *              ),
 *             )
 *         )
 *     )
 *
 *    ),
 *
 *
 * @OA\Patch(
 *       path="/api/v1/collections/{id}",
 *       summary="Update collection data",
 *       tags={"Word Collection"},
 *       security={{"sanctum": {}}},
 *       @OA\Parameter(
 *             name="id",
 *             in="path",
 *             description="id of collection",
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
 *                        @OA\Property(property="name", type="string", example="Text name"),
 *                        @OA\Property(property="text", type="string", example="Text in english"),
 *                        @OA\Property(property="translationUk", type="string", example="Текст українською"),
 *                        @OA\Property(property="status", type="string", example="public"),
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
 *            @OA\Property(property="message", type="string", example="collection successfully changed"),
 *            @OA\Property(
 *                property="data",
 *                type="object",
 *                example="",
 *            )
 *        )
 *    )
 *
 *   ),
*/
class WordCollectionController extends Controller
{

}
