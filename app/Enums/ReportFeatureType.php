<?php

declare(strict_types=1);

namespace App\Enums;

use App\Features\Directory;
use App\Features\Grid;

enum ReportFeatureType: string implements FeatureType
{
    case Table = Grid::class;
    case Directory = Directory::class;

    public function feature(): string
    {
        return $this->value;
    }
}
