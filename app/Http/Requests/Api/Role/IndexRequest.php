<?php

namespace App\Http\Requests\Api\Role;

use App\Models\Role;

use App\Http\Requests\Api\Request;

final class IndexRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Role::class);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'date' => ['nullable', 'array:from,to'],
            'date.from' => ['required_if:date', 'distinct:strict', 'date', 'before:date.to'],
            'date.to' => ['required_if:date', 'distinct:strict', 'date', 'after:date.from'],
            'sort' => ['nullable', 'array:by,type'],
            'sort.by' => ['required_if:sort', 'distinct:strict', 'string', 'max:255', 'in:id,name,slug,created_at'],
            'sort.type' => ['required_if:sort', 'distinct:strict', 'string', 'max:255', 'in:asc,desc'],
        ];
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->only([
            'search',
            'name',
            'slug',
            'date',
            'sort',
        ]);
    }
}
