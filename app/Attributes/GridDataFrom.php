<?php

namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class GridDataFrom
{
    public function __construct(protected $form = null)
    {
    }
}
