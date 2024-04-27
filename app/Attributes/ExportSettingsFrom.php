<?php

namespace App\Attributes;

use Attribute;
use App\Enums\ExportSettings;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class ExportSettingsFrom
{
    public function __construct(protected ExportSettings $key, protected mixed $value)
    {
    }
}
