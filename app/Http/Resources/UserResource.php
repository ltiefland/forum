<?php

/**
 * UserResource represents a resource transformation layer
 * for user-related data in the application.
 *
 * This resource is responsible for converting the user model
 * into a JSON serializable structure that complies with
 * the API response format for the Laravel application.
 *
 * Key responsibilities:
 * - Define the structure of the user resource.
 * - Conditionally expose the user's email if it matches
 *   the authenticated user's ID.
 * - Include timestamps and profile photo URL for completeness.
 *
 * Dependencies:
 * - Illuminate\Http\Request: Provides the HTTP request instance
 *   for conditional data exposure.
 * - Illuminate\Http\Resources\Json\JsonResource: Serves as
 *   the base resource class for JSON serialization.
 */

namespace App\Http\Resources;

use /**
 * Class Request
 *
 * The Illuminate HTTP Request component is used to handle HTTP requests in Laravel applications.
 * It provides an interface for interacting with HTTP requests and retrieving input data from them.
 * The Request class is part of the `Illuminate\Http` namespace.
 *
 * Features:
 * - Access request parameters, headers, and cookies.
 * - Retrieve input data via various formats (e.g., query, POST, JSON).
 * - Handle file uploads.
 * - Retrieve request metadata such as method, URL, and IP address.
 * - Supports request validation and sanitization.
 *
 * Methods:
 * - Provides methods to access and manipulate the request input.
 * - Allows detection of headers, content type, and request origins.
 * - Supports HTTP-related operations such as response generation.
 *
 * Note: This class is instantiated and utilized by Laravel's routing and controller systems.
 */
    Illuminate\Http\Request;
use /**
 * Class JsonResource
 *
 * This class extends the base functionality of a JSON resource in Laravel,
 * providing utilities for transforming resources into JSON format for API responses.
 */
    Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 */
class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->when($this->id === $request->user()?->id, $this->email),
            'profile_photo_url' => $this->profile_photo_url,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
