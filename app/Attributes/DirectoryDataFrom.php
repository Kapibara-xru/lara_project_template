<?php

namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class DirectoryDataFrom
{
    public function __construct(protected $form = null)
    {
    }
}
