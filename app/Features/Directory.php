<?php

declare(strict_types=1);

namespace App\Features;

use App\Attributes\DirectoryDataFrom;
use App\Attributes\DirectoryRequestFrom;
use App\Attributes\DirectoryResourceFrom;
use App\Concerns\Grid\HasGridRepository;
use App\Contracts\Grid\DirectoryData;
use App\DTO\DefaultDirectoryData;
use App\Http\Requests\GridRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use ReflectionException;

final class Directory implements Feature
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
            $this->data = $this->repository()->getDirectories($this->dto());
        }

        return $this->data;
    }

    /**
     * @throws ReflectionException
     * @throws BindingResolutionException
     */
    public function dto(): DirectoryData
    {
        return $this->getDtoByRequest($this->request());
    }

    /**
     * @throws ReflectionException
     * @throws BindingResolutionException
     */
    public function response(): JsonResponse|JsonResource
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
            $this->getAttribute(DirectoryRequestFrom::class, GridRequest::class)
        );
    }

    /**
     * @throws ReflectionException
     */
    public function resource(Collection|array $data): JsonResource|JsonResponse
    {
        $resource = $this->getAttribute(DirectoryResourceFrom::class, JsonResponse::class);

        return new $resource($data);
    }

    /**
     * @throws ReflectionException
     */
    private function getDtoByRequest(FormRequest $request): DirectoryData
    {
        /**
         * @var DirectoryData $dto
         */
        $dto = $this->getAttribute(DirectoryDataFrom::class, DefaultDirectoryData::class);

        return $dto::from($request->validated());
    }

    /**
     * @return class-string
     *
     * @throws ReflectionException
     */
    private function getAttribute(string $key, string $default): string
    {
        return getReflectionAttribute($this->context, $key, $default);
    }
}
