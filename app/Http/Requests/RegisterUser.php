<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUser extends FormRequest
{

    protected $redirect = "/login#form1";
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
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function response(array $errors)
    {
      return redirect('/dd');
      return response()->json([
        'code' => '404',
        'errors' => $errors,
      ]);
    }
}
