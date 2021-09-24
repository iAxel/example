<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Model;

trait HasId
{
    /**
     * @param int $id
     *
     * @return Model|null
     */
    public function findById(int $id): Model|null
    {
        return $this->newQuery()->where('id', '=', $id)->first();
    }
}
