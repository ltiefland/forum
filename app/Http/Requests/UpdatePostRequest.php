<?php

/**
 * Class UpdatePostRequest
 *
 * This class handles the validation and authorization logic for updating a post.
 * It extends the FormRequest class provided by Laravel's Foundation.
 *
 * The authorize method determines whether the user is authorized to make this request.
 * The rules method defines the validation rules that should be applied to the request data.
 */

namespace App\Http\Requests;

use /**
 * Class description for a FormRequest in a Laravel application.
 *
 * FormRequest is used to encapsulate the logic related to
 * validating and authorizing a form request.
 *
 * This class extends Illuminate\Foundation\Http\FormRequest
 * and provides methods for defining validation rules
 * and authorization logic specific to a request.
 *
 * @see \Illuminate\Foundation\Http\FormRequest
 */
    Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
