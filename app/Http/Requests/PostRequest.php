<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
             'post.product' => 'required|string|max:100',
             'post.price' => 'required|numeric|max:100',
             'post.maximum_dpi' => 'required|numeric|max:100',
             'post.weight' => 'required|numeric|max:100',
             'post.buttons' => 'required|numeric|max:100',
            'post.explanation' => 'required|string|max:4000',
        ];
    }
}
