<?php

namespace App\Http\Requests;

use Pearl\RequestValidate\RequestAbstract;
use App\User;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends RequestAbstract
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
            'name'    => 'required',
            'roles.*' => 'integer',
            'roles'   => 'required|array',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            //
        ];
    }
}
