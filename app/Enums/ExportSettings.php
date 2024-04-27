<?php

declare(strict_types=1);

namespace App\Enums;

enum ExportSettings: string
{
    case Orientation = 'snappy.orientation';
    case ViewWord = 'templateWord';
    case TemplateExcel = 'templateXlSX';
    case ViewExcel = 'viewXlSX';
    case ViewPdf = 'templatePDF';
    case ColsWidth = 'colsWidth';

    case ReportName = 'reportName';
}
