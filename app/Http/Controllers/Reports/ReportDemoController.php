<?php

namespace App\Http\Controllers\Reports;

use App\Attributes\ExportJobFrom;
use App\Attributes\ExportSettingsFrom;
use App\Attributes\GridDataFrom;
use App\Attributes\GridResourceFrom;
use App\Attributes\ReportSettingsID;
use App\Enums\ExportSettings;
use App\Http\Controllers\Controller;
use App\Traits\HasDirectories;

#[
    ReportSettingsID('report_demo'),
//    GridDataFrom(ReportDemoData::class),
//    GridResourceFrom(ReportDemoResource::class),
//    ExportJobFrom(ReportDemoExport::class),
    ExportSettingsFrom(ExportSettings::ViewExcel, 'export.excel.report'),
]
final class ReportDemoController extends Controller
{
    use HasDirectories;
}
