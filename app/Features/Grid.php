<?php

declare(strict_types=1);

namespace App\Features;

use App\Attributes\GridDataFrom;
use App\Attributes\GridRequestFrom;
use App\Attributes\GridResourceFrom;
use App\Concerns\Grid\HasGridRepository;
use App\Contracts\Grid\GridData;
use App\DTO\DefaultGridData;
use App\Http\Requests\GridRequest;
use App\Http\Resources\GridResource;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use ReflectionException;

final class Grid implements Feature
{
    use HasGridRepository;

    private Collection|array|null $data = null;

    public function __construct(private readonly string $context)
    {
    }

    /**
     * @throws BindingResolutionException
     * @throws ReflectionException
     */
    public function data(): Collection|array
    {
        if (! $this->data) {
            $this->data = $this->repository()->getTable($this->dto());
        }

        return $this->data;
    }

    /**
     * @throws ReflectionException
     * @throws BindingResolutionException
     */
    public function dto(): GridData
    {
        return $this->getDtoByRequest($this->request());
    }

    /**
     * @throws ReflectionException
     * @throws BindingResolutionException
     */
    public function response(): JsonResource
    {
        return $this->resource($this->data());
    }

    /**
     * @throws ReflectionException
     * @throws BindingResolutionException
     */
    public function request(): FormRequest
    {
        return app()->make(
            $this->getAttribute(GridRequestFrom::class, GridRequest::class)
        );
    }

    /**
     * @throws ReflectionException
     */
    public function resource(Collection|array $data): JsonResource
    {
        $gridResource = $this->getAttribute(GridResourceFrom::class, GridResource::class);

        return new $gridResource($data);
    }

    /**
     * @throws ReflectionException
     */
    private function getDtoByRequest(FormRequest $request): GridData
    {
        /**
         * @var GridData $gridData
         */
        $gridData = $this->getAttribute(GridDataFrom::class, DefaultGridData::class);

        return $gridData::from($request->validated());
    }

    /**
     * @return class-string
     * @throws ReflectionException
     */
    private function getAttribute(string $key, string $default): string
    {
        return getReflectionAttribute($this->context, $key, $default);
    }
}
