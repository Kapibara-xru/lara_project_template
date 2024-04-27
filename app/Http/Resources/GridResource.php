<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GridResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $this->resource = is_array($this->resource) ? collect($this->resource) : $this->resource;

        return [
            'headers' => GridHeaderResource::collection($this->resource->get('headers') ?? []),
            'rows' => $this->resource->get('rows') ?? [],
            'directories' => $this->resource->get('directories') ?? [],
            'meta_cells' => $this->resource->get('meta_cells') ?? [],
            'meta_rows' => $this->resource->get('meta_rows') ?? [],
            'total' => $this->resource->get('total') ?? 0,
        ];
    }
}
