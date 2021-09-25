<?php

namespace App\Http\Requests\Api\User;

use App\Models\User;

use App\Http\Requests\Api\Request;

final class CreateRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', User::class);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'max:255'],
        ];
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->only([
            'name',
            'email',
            'password',
        ]);
    }
}
