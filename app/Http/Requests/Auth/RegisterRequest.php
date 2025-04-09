<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Rules\AlphaSpace;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', new AlphaSpace, 'max:25'],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => [
                'required',
                Password::min(8)
                        ->letters()
                        ->numbers()
                        ->symbols()
            ],
            'password_confirmation' => ['required', 'same:password']
        ];
    }
}
