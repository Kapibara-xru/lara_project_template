<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GridHeaderResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $this->resource = is_array($this->resource) ? collect($this->resource) : $this->resource;

        return [
            ...$this->main(),
            ...$this->meta(),
            ...$this->options(),
            ...$this->filtration(),
            ...$this->validation(),
        ];
    }

    private function main(): array
    {
        return [
            'id' => $this->resource->get('id'),
            'parent_id' => $this->resource->get('parent_id'),
            'title' => $this->resource->get('title') ?? $this->resource->get('name') ?? '',
            'field' => $this->resource->get('field') ? strtolower($this->resource->get('field')) : null,
        ];
    }

    private function meta(): array
    {
        return [
            'code' => $this->resource->get('code'),
            'class' => $this->resource->get('class') ?? '',
            'width' => $this->resource->get('width') ?? '100px',
            'data_type' => $this->resource->get('data_type') ?? 'text',
        ];
    }

    private function options(): array
    {
        return [
            'editable' => (bool) $this->resource->get('editable'),
            'sorted' => ! ($this->resource->get('sorted') !== null) || $this->resource->get('sorted'),
            'required' => (bool) $this->resource->get('required'),
            'grouping' => $this->booleanNotNull('grouping'),
            'fixed' => (bool) $this->resource->get('fixed'),
            'expand' => (bool) $this->resource->get('expand'),
            'combine' => $this->boolean('combine'),
            'combine_col' => $this->boolean('combine_col') ?? (is_string($this->resource->get('combine_col'))
                    ? explode(',', $this->resource->get('combine_col'))
                    : $this->resource->get('combine_col')),
            'column_all_checkbox' => $this->resource->get('column_all_checkbox'),
        ];
    }

    private function filtration(): array
    {
        return [
            'data_dict_id' => $this->resource->get('data_dict_id'),
            'filter_dict_id' => $this->resource->get('filter_dict_id'),
            'filter_column_id' => $this->resource->get('filter_column_id'),
        ];
    }

    private function validation(): array
    {
        return [
            'data_min_value' => $this->resource->get('data_min_value'),
            'data_max_value' => $this->resource->get('data_max_value'),
            'data_length' => $this->resource->get('data_length'),
            'data_precision' => $this->resource->get('data_precision'),
        ];
    }

    private function boolean(string $field): mixed
    {
        return is_bool($this->resource->get($field))
            ? (bool) $this->resource->get($field)
            : $this->resource->get($field);
    }

    private function booleanNotNull(string $field): mixed
    {
        return $this->resource->get($field) !== null
            ? (bool) $this->resource->get($field)
            : $this->resource->get($field);
    }
}
