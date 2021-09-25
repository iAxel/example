<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\Request;

use App\Http\Requests\Traits\HasId;

final class ShowRequest extends Request
{
    use HasId;

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('view', $this->getId());
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
}
