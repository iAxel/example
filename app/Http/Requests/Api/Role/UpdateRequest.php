<?php

namespace App\Http\Requests\Api\Role;

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
            'name' => ['required', 'string', 'max:255', 'slug:roles,' . $this->getId()],
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
