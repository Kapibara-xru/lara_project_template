<?php

namespace App\DTO\Casts;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class CollectionCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): Collection
    {
        return collect($value);
    }
}
