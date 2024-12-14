<?php

/**
 * TopicResource is responsible for transforming topic-related data into an array structure
 * suitable for JSON responses.
 *
 * This resource adheres to Laravel's JSON Resource structure and provides an abstraction
 * layer between the database models and API responses.
 *
 * @package App\Http\Resources
 * @extends JsonResource
 */

namespace App\Http\Resources;

use /**
 * This class is part of the Laravel framework, extending the Symfony HTTP Request class.
 * It manages HTTP request lifecycle for the application, providing methods to retrieve,
 * input, headers, and files, as well as support for retrieving validated inputs, query
 * parameters, session data, and more.
 *
 * Key Features:
 * - Access input data through various methods such as `input()`, `all()`, or magic properties.
 * - Retrieve query parameters, route parameters, or JSON payloads.
 * - Handle server, file, and session data.
 * - Support for file uploads and manipulation.
 * - Validation handling for request data.
 *
 * This class is utilized in Laravel's dependency injection container for controller
 * methods, middleware, and form request handling.
 */
    Illuminate\Http\Request;
use /**
 * The JsonResource class provides a way to transform your models and other data into JSON for API responses.
 * It is part of the Laravel framework and extends Laravel's powerful resource functionality.
 *
 * Utilizing JsonResource allows you to customize how individual model data is structured and returned
 * as part of a JSON API response, ensuring a deliberate and controlled data presentation to consumers.
 *
 * This class is typically extended to define specific data transformation for an entity.
 *
 * Use cases for the JsonResource include:
 * - Formatting model attributes before they are returned.
 * - Adding or removing fields dynamically from the response based on user roles or permissions.
 * - Combining additional related data into the response, such as relationships.
 *
 * JsonResource works seamlessly with collections and models, providing a consistent
 * and convenient approach to return structured JSON responses.
 */
    Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 */
class TopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
