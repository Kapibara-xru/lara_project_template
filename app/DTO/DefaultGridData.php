<?php

namespace App\DTO;

use App\Concerns\DTO\HasBindings;
use App\Contracts\Grid\GridData;
use App\DTO\Casts\CollectionCast;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

/**
 * @template TExtends
 *
 * @extends  DefaultGridData<TExtends>
 */
final class DefaultGridData extends Data implements GridData
{
    use HasBindings;

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

    public function bindings(): array
    {
        return collect($this->toArray())
            ->mapWithKeys(fn ($item, $key) => (["p_$key" => $item]))
            ->toArray();
    }
}
