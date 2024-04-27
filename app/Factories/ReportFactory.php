<?php

declare(strict_types=1);

namespace App\Factories;

use App\Enums\FeatureType;
use App\Features\Feature;

final class ReportFactory implements FeatureFactory
{
    public static function make(string $context, FeatureType $type): Feature
    {
        return new ($type->feature())($context);
    }
}
