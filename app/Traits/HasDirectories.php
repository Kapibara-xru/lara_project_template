<?php

namespace App\Traits;

use App\Enums\ReportFeatureType;
use App\Factories\FeatureFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

trait HasDirectories
{
    public function directories(FeatureFactory $factory): JsonResource|JsonResponse
    {
        return $factory
            ->make(static::class, ReportFeatureType::Directory)
            ->response();
    }
}
