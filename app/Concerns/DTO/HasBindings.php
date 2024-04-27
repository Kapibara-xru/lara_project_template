<?php

declare(strict_types=1);

namespace App\Concerns\DTO;

trait HasBindings
{
    abstract public function toArray(): array;

    public function bindings(): array
    {
        return collect($this->toArray())
            ->mapWithKeys(fn ($item, $key) => (["p_$key" => $item]))
            ->toArray();
    }
}
