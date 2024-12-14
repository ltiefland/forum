<?php

/**
 * PostResource class is responsible for transforming the post model into a JSON representation.
 *
 * It extends the JsonResource class provided by Laravel and defines the transformation logic
 * to structure the post resource with associated relationships and formatted data.
 */

namespace App\Http\Resources;

    use /**
     * Class Number
     *
     * Provides methods for working with and formatting numbers.
     *
     * @package Illuminate\Support
     */
        Illuminate\Support\Number;
    use /**
     * Class Request
     *
     * The Request class extends the Symfony HTTP Request and provides an object-oriented representation
     * of an HTTP request. It contains methods for examining and manipulating the HTTP request data,
     * such as input data, query parameters, headers, cookies, files, and sessions.
     *
     * @package Illuminate\Http
     *
     * @method bool isMethod(string $method)           Determine if the HTTP request method matches the given method.
     * @method bool isJson()                           Determine if the HTTP request expects a JSON response.
     * @method bool wantsJson()                        Determine if the HTTP request is asking for JSON.
     * @method array all($keys = null)                 Retrieve all input and query parameters as an array.
     * @method string|array input(string|null $key = null, mixed $default = null)
     *                                                Retrieve input data for the specified key or all input data.
     * @method string fullUrl()                        Get the full URL requested, including query string parameters.
     * @method string url()                            Get the path of the URL without query string.
     * @method string ip()                             Get the client IP address making the request.
     * @method bool has(string|array $key)            Determine if the request contains a given input parameter.
     * @method mixed header(string $key, mixed $default = null)
     *                                                Retrieve a specified header value from the request.
     * @method string|array query(string $key = null, mixed $default = null)
     *                                                Retrieve a query string parameter for a given key or all query parameters.
     * @method bool filled(string|array $key)         Determine if the input exists and is not empty.
     * @method bool missing(string|array $key)        Determine if the input is missing from the request.
     * @method string method()                        Retrieve the current HTTP request method.
     * @method mixed session()                        Retrieve the session instance associated with the request.
     * @method bool exists(string|array $key)         Alias for 'has', determine if an input key exists in the request data.
     * @method array validate(array $rules, array $messages = [], array $customAttributes = [])
     *                                                Validate the request with the specified validation rules.
     * @method string path()                          Retrieve the request URI path.
     */
        Illuminate\Http\Request;
    use /**
     * Class JsonResource
     *
     * This class represents an abstract resource for a JSON response in a Laravel application.
     * It is typically used for transforming data before sending it as a JSON response,
     * allowing complex data structures to be transformed into a consistent and presentable format.
     *
     * @package Illuminate\Http\Resources\Json
     */
        Illuminate\Http\Resources\Json\JsonResource;

    /**
     * Class PostResource
     *
     * Represents a JSON resource for a Post entity, providing
     * structured data transformation for an API response.
     */
    class PostResource extends JsonResource
    {
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
                'topic'       => TopicResource::make( $this->whenLoaded( 'topic' ) ),
                'title'       => $this->title,
                'body'        => $this->body,
                'html'        => $this->html,
                'likes_count' => Number::format( $this->likes_count, null, null, 'de_DE' ),
                'updated_at'  => $this->updated_at,
                'created_at'  => $this->created_at,
                'routes'      => [
                    'show' => $this->showRoute(),
                ],
            ];
        }
    }
