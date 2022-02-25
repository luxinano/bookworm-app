<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|integer',
            'author_id' => 'required|integer',
            'book_title' => 'required|string',
            'book_summary' => 'required|string',
            'book_price' => 'required|numeric',
            'book_cover_photo' => 'nullable|string',
        ];
    }
}
