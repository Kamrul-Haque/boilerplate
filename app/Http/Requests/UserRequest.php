<?php

namespace App\Http\Requests;

use App\Enums\Role;
use App\Rules\AlphaSpace;
use App\Rules\Phone;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UserRequest extends FormRequest
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
            'name' => ['required', new AlphaSpace, 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'phone' => ['nullable', new Phone, 'max:255', Rule::unique('users')->ignore($this->user)],
            'address' => ['nullable', 'string', 'max:255'],
            'role' => ['required', new Enum(Role::class)],
            'image' => [...$this->isPrecognitive() ? [] : ['nullable'], 'image', 'max:5120'],
        ];
    }
}
