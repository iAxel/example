<?php

namespace App\Http\Requests\Traits;

trait HasId
{
    /**
     * @return string
     */
    private function getId(): string
    {
        return $this->route()->parameter('id');
    }
}
