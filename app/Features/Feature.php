<?php

declare(strict_types=1);

namespace App\Features;

use App\Contracts\Grid\GridRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Contracts\DataObject;

interface Feature
{
    public function repository(): GridRepository;
    public function request(): FormRequest;
    public function response(): JsonResponse|JsonResource;
    public function resource(Collection|array $data): JsonResponse|JsonResource;
    public function data(): Collection|array;
    public function dto(): DataObject;

}
