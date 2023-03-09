<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', "regex:/^[a-zA-Z ,.'-]+(?: [a-zA-Z ,.'-]+)*$/", 'min:5', 'max:75', 'unique:departments'],
            'description' => ['required', 'string', 'min:5'],
            'status' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Department name is required.',
            'name.regex' => 'Please enter a valid Department name.',
            'name.min' => 'Department name must be at least :min characters long.',
            'name.max' => 'Department name must not be greater than :max characters long.',
            'name.unique' => 'Department name already exists.',
            'description.required' => 'Select a Department.',
            'description.min' => 'Description must be atleast :min to :max characters long.',
            'status.required' => 'Select a status.',
        ];
    }
}
