<?php

declare(strict_types=1);

namespace App\Grid\Repositories;

use App\Contracts\Grid\DirectoryData;
use App\Contracts\Grid\GridData;
use App\Contracts\Grid\GridRepository;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

final readonly class CachedGridRepository implements GridRepository
{
    public function __construct(
        private string $cachePrefix,
        private GridRepository $repository,
        private CacheManager $cache,
    ) {
    }

    public function getTable(GridData $data): Collection|array
    {
        return $this->cache->remember(
            key: $this->cacheKey(collect($data->bindings())->toJson()),
            ttl: Carbon::now()->addHours(3),
            callback: fn () => $this->repository->getTable($data)
        );
    }

    public function getHeaders(GridData $data): Collection|array
    {
        return $this->repository->getHeaders($data);
    }

    public function getRows(GridData $data): Collection|array
    {
        return $this->repository->getRows($data);
    }

    public function getDirectories(DirectoryData $data): Collection|array
    {
        return $this->cache->remember(
            key: $this->cacheKey($data->toJson()),
            ttl: Carbon::now()->addHours(3),
            callback: fn () => $this->repository->getDirectories($data)
        );
    }

    private function cacheKey(string $cacheName): string
    {
        return sprintf('%s%s',
            $this->cachePrefix,
            $cacheName
        );
    }
}
