<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'string',
            'content' => 'string',
            'category_id' => '',
            'page' => '',
            'per_page' => ''
        ];
    }
}
