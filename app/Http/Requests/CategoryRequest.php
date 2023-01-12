<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            //Category rules
            'category_name' => 'required | unique:categories',        //Table name = categories 
        ];
    }

    public function messages()
    {
        return [
            //Category error messages
            'category_name.required' => 'Category field cannot be empty!',
            'category_name.unique' => 'This category already exists!',
        ];
    }
}
