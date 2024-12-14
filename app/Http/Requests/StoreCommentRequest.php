<?php

/**
 * Handles the validation and authorization for storing comments.
 *
 * This request class is responsible for validating the data sent when creating
 * or storing a comment. It can also handle custom authorization logic to decide
 * if a user is permitted to perform this action.
 *
 * @package App\Http\Requests
 */

namespace App\Http\Requests;

use /**
 * Illuminate\Foundation\Http\FormRequest
 *
 * This class is an extension of the base HTTP request in Laravel, designed specifically for form validation.
 * It provides an elegant way to handle form requests, including validation rules and authorization logic.
 *
 * - Automatically handles validation and throws the appropriate HTTP response upon failure.
 * - Allows customization of validation rules and error messages.
 * - Contains optional `authorize` method to determine if the user is authorized to perform the request.
 *
 * Core Features:
 * - Validation rules can be defined in the `rules` method.
 * - Custom validation messages can be set in the `messages` method.
 * - The request data automatically passes through validation and is available to use within the application.
 * - Maintains compatibility with Laravel's IoC container for dependency injection.
 * - Extends the base `Request` class for HTTP functionality while adding validation and form-specific behaviors.
 *
 * Usage:
 * Intended to represent a form data request that can be validated and authorized.
 * Useful for decoupling request validation logic from controller methods.
 *
 * Dependencies:
 * - Relies on Laravel's validation logic provided by the Validator component.
 * - Can work in conjunction with other Laravel components like middleware and controllers.
 *
 * Typical Workflow:
 * - Define a custom class extending `FormRequest` for each form in the application.
 * - Specify validation rules in the `rules` method.
 * - Implement the `authorize` method to restrict form submissions based on user roles or permissions.
 * - Inject the request into a controller method for use after validation is successful.
 */
    Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
