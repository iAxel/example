<?php

namespace App\Http\Requests\Api\Role;

use App\Http\Requests\Api\Request;

final class CreateRequest extends Request
{
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
            'name' => ['required', 'string', 'max:255', 'slug:roles'],
        ];
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->only([
            'name',
        ]);
    }
}
