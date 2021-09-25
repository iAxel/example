<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\Request;

use App\Http\Requests\Traits\HasToken;

final class LogoutRequest extends Request
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
