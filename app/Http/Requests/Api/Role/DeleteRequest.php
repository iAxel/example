<?php

namespace App\Http\Requests\Api\Role;

use App\Http\Requests\Api\Request;

final class DeleteRequest extends Request
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
        return [];
    }
}
