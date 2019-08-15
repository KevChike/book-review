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
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:255', 'unique:books'],
            'author' => ['required', 'string', 'max:255'],
            'edition' => ['required', 'string', 'max:50'],
            'summary' => ['required', 'string', 'max:255'],
            'publication_year' => ['required', 'string'],
        ];
    }
}
