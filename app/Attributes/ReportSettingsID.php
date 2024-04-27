<?php

namespace App\Attributes;

use Attribute;

#[Attribute]
class ReportSettingsID
{
    public function __construct(protected $reportId = '')
    {
    }
}
