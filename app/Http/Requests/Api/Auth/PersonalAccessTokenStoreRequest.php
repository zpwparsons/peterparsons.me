<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $device_name
 * @property string $email
 * @property string $password
 */
class PersonalAccessTokenStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
            ],
            'device_name' => [
                'required',
            ],
        ];
    }
}
