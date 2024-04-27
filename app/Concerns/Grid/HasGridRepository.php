<?php

declare(strict_types=1);

namespace App\Concerns\Grid;

use App\Contracts\Grid\GridRepository;
use Illuminate\Contracts\Container\BindingResolutionException;

trait HasGridRepository
{
    /**
     * @throws BindingResolutionException
     */
    public function repository(): GridRepository
    {
        return app()->make(GridRepository::class);
    }
}
