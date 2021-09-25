<?php

namespace App\Http\Requests\Api\Policy;

use App\Http\Requests\Api\Request;

final class ShowRequest extends Request
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
