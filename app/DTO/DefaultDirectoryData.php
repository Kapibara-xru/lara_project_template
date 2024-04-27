<?php

namespace App\DTO;

use App\Contracts\Grid\DirectoryData;
use App\DTO\Casts\CollectionCast;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

/**
 * @template TExtends
 *
 * @extends  DefaultDirectoryData<TExtends>
 */
final class DefaultDirectoryData extends Data implements DirectoryData
{
    /**
     * @param  Collection  $filters Коллекция фильтров
     * @param  Collection  $additionals  Коллекция доп. параметров
     * @param  int|null  $page  Текущая страница пагинации
     * @param  int|null  $perPage  Количество строк на странице
     * @param  bool  $isExport  Выполняется ли запрос экспортом
     */
    public function __construct(
        #[WithCast(CollectionCast::class)]
        public Collection $filters,

        #[WithCast(CollectionCast::class)]
        public Collection $additionals,

        public ?int $page,

        public ?int $perPage,

        public bool $isExport,
    ) {
    }
}
