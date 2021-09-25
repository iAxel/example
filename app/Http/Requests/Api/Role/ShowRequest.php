<?php

namespace App\Http\Requests\Api\Role;

use App\Models\Role;

use App\Http\Requests\Api\Request;

final class ShowRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('view', Role::class);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
}
