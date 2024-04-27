<?php

namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class GridRequestFrom
{
    public function __construct(protected $request = null)
    {
    }
}
