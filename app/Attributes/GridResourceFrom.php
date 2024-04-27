<?php

namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class GridResourceFrom
{
    public function __construct(protected $resource = null)
    {
    }
}
