<?php

namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class ExportJobFrom
{
    public function __construct(protected $job = null)
    {
    }
}
