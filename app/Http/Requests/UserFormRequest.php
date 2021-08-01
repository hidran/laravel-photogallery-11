<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth, Illuminate\Validation\Rule;
class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       $id = $this->user?->id;
      $emailRule = $id ? Rule::unique('users')->ignore($id):Rule::unique('users');
        return
            [
                'name' => 'required|string|max:255',
                'email' => [
                    'required','string','email','max:255',
                    $emailRule
                ],
               'user_role' => Rule::in(['user', 'admin']),

            ]
        ;
    }
    public function messages()
    {
        $messages = [
            'name.required' => 'User role is required',
            'name.unique' => 'Name already taken',
            'email.required' => 'Email role is required',
            'email.unique' => 'Email already taken',
            'user_role.required' => 'User role is required'

        ];
        return $messages;
    }
}
