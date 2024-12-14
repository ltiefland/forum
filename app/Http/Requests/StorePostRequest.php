<?php

/**
 * StorePostRequest handles the validation logic for storing a post.
 *
 * This request is used to validate the input data provided by the user
 * when creating a new post in the application.
 *
 * @package App\Http\Requests
 */

namespace App\Http\Requests;

use /**
 * This class is a custom request implementation for validating and authorizing
 * incoming HTTP requests in the application.
 *
 * It extends the `Illuminate\Foundation\Http\FormRequest` class to provide
 * capabilities for defining validation rules and authorization logic
 * for specific requests.
 *
 * Usage requires defining the desired validation and authorization logic
 * within this class and using it in the associated controller.
 *
 * @see Illuminate\Foundation\Http\FormRequest
 */
    Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class StorePostRequest extends FormRequest
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
