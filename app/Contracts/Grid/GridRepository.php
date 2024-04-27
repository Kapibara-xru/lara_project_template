<?php

namespace App\Contracts\Grid;

use Illuminate\Support\Collection;

interface GridRepository
{
    public function getTable(GridData $data): Collection|array;

    public function getHeaders(GridData $data): Collection|array;

    public function getRows(GridData $data): Collection|array;

    public function getDirectories(DirectoryData $data): Collection|array;
}
