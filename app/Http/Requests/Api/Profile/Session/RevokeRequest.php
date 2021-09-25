<?php

namespace App\Http\Requests\Api\Profile\Session;

use App\Http\Requests\Api\Request;

use App\Http\Requests\Traits\HasToken;

final class RevokeRequest extends Request
{
    use HasToken;

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
