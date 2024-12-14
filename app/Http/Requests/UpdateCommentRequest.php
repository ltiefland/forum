<?php

/**
 * Class UpdateCommentRequest
 *
 * This class handles the validation logic for updating a comment in the application.
 * It extends the FormRequest class provided by Laravel, which is designed to handle
 * validation and authorization of HTTP requests.
 *
 * The class includes methods to determine user authorization and to specify the
 * validation rules for the request.
 */

namespace App\Http\Requests;

use /**
 * Class responsible for handling form validation and authorization in a Laravel application.
 *
 * This class extends the Illuminate\Foundation\Http\FormRequest, providing
 * functionality to validate and authorize user requests within the application.
 *
 * Usage:
 * - Define validation rules by overriding the `rules` method.
 * - Define conditional authorization logic by overriding the `authorize` method.
 * - Automatically apply validation to incoming HTTP requests using a controller.
 *
 * @package Illuminate\Foundation\Http
 */
    Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class UpdateCommentRequest extends FormRequest
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
