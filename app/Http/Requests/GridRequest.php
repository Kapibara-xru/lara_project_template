<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GridRequest extends FormRequest
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'filters' => 'array',
            'additionals' => 'array',
            'page' => 'numeric|nullable',
            'perPage' => 'numeric|nullable',
            'isExport' => 'bool',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'filters' => $this->input('filters') ?? [],
            'additionals' => $this->input('additionals') ?? [],
            'isExport' => $this->isExport(),
        ]);
    }

    public function isExport(): bool
    {
        return $this->route()?->getActionMethod() === 'export';
    }
}
