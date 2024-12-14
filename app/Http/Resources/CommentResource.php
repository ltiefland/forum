<?php

/**
 * CommentResource is responsible for transforming the Comment model data into a structured array
 * for use in API responses. It includes related resources and additional computed properties.
 *
 * @property int $id The primary identifier of the comment.
 * @property mixed $user The related user resource.
 * @property mixed $post The related post resource.
 * @property string $body The text content of the comment.
 * @property string $html The HTML formatted content of the comment.
 * @property int $likes_count The number of likes associated with the comment.
 * @property \Illuminate\Support\Carbon $updated_at The timestamp for the last update of the comment.
 * @property \Illuminate\Support\Carbon $created_at The timestamp for when the comment was created.
 * @property array $can An array defining the authorization permissions for the current user (update and delete).
 */

namespace App\Http\Resources;

    use App\Models\Like;
    use /**
     * Class Request
     *
     * The Request class provides an object-oriented, convenient way to interact with the HTTP request data in a Laravel application.
     * It extends Symfony's HTTP Foundation request class, adding Laravel-specific methods and helpers.
     * This class is used to retrieve information about the HTTP request, such as headers, cookies, inputs, and server variables.
     *
     * Common functionalities in the Request class include access to query parameters, input data, uploaded files, request headers,
     * as well as utilities for request inspection and route matching.
     *
     * Note: The HTTP request object is created for every user request and is injected into application controllers
     *       or handled using dependency injection.
     *
     * Features:
     * - Access query string parameters and input data.
     * - Retrieve and manipulate cookies and headers.
     * - Handle file uploads.
     * - Inspect request metadata, including URL, method, and client details.
     * - Validate data from the request inputs.
     *
     * Example usages should not be included in this documentation as per instruction.
     *
     * Key Methods:
     * - input($key = null, $default = null): Retrieve input data.
     * - all(): Get all input data for the request.
     * - only(array|string $keys): Get only specified input values.
     * - except(array|string $keys): Get all input excluding specific keys.
     * - has($key): Verify if a key is present in the input data.
     * - file($key): Access uploaded file information.
     * - method(): Retrieve the HTTP method of the request.
     * - url(): Get the full URL for the request.
     * - header($key = null, $default = null): Access headers from the request.
     * - cookie($key = null, $default = null): Retrieve cookie data.
     */
        Illuminate\Http\Request;
    use /**
     * Class JsonResource
     *
     * Represents a resource in the form of JSON for API responses.
     * Extends from Laravel's base class for JSON resources.
     * This class is commonly utilized to transform data before returning it as JSON.
     *
     * @package Illuminate\Http\Resources\Json
     */
        Illuminate\Http\Resources\Json\JsonResource;
    use /**
     * Class Number
     *
     * Provides utility methods for working with numeric values.
     * Contains helpers to handle and format numeric data.
     *
     * @package Illuminate\Support
     */
        Illuminate\Support\Number;

    /**
     * Class CommentResource
     *
     * This resource class is responsible for transforming the comment data into an array structure tailored for API responses.
     */
    class CommentResource extends JsonResource
    {
        /**
         * @var true
         */
        private bool $withLikePermission = false;

        public function withLikePermission(): self
        {
            $this->withLikePermission = true;
            return $this;
        }

        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray( Request $request ): array
        {
            return [
                'id'          => $this->id,
                'user'        => UserResource::make( $this->whenLoaded( 'user' ) ),
                'post'        => PostResource::make( $this->whenLoaded( 'post' ) ),
                'body'        => $this->body,
                'html'        => $this->html,
                'likes_count' => Number::format( $this->likes_count, null, null, 'de_DE' ),
                'updated_at'  => $this->updated_at,
                'created_at'  => $this->created_at,
                'can'         => [
                    'update' => $request->user()?->can( 'update', $this->resource ),
                    'delete' => $request->user()?->can( 'delete', $this->resource ),
                    'like'   => $this->when( $this->withLikePermission, fn() => $request->user()?->can( 'create', [ Like::class, $this->resource ] ) ),
                ],
            ];
        }
    }
