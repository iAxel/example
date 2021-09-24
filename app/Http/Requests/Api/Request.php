<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * @return bool
     */
    abstract public function authorize(): bool;

    /**
     * @return array
     */
    abstract public function rules(): array;
}
