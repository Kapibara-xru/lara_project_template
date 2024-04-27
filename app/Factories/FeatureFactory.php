<?php

declare(strict_types=1);

namespace App\Factories;

use App\Enums\FeatureType;
use App\Features\Feature;

interface FeatureFactory
{
    public static function make(string $context, FeatureType $type): Feature;
}
