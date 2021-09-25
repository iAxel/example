<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\Request;

use App\Http\Requests\Traits\HasId;

final class UpdateRequest extends Request
{
    use HasId;

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users,email,' . $this->getId()],
            'password' => ['nullable', 'string', 'min:6', 'max:255'],
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
