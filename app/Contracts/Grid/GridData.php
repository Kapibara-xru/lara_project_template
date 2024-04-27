<?php

declare(strict_types=1);

namespace App\Contracts\Grid;

use Spatie\LaravelData\Contracts\DataObject;

/**
 * @template T
 */
interface GridData extends DataObject
{
    /**
     * @return non-empty-array<array-key, mixed>
     */
    public function bindings(): array;
}
