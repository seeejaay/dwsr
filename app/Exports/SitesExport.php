<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SitesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $siteDetails;

    public function __construct($siteDetails)
    {
        $this->siteDetails = $siteDetails;
    }

    public function collection()
    {
        return collect($this->siteDetails);
    }

    public function map($site): array
    {
        return [
            $site->owner,
            $site->ship_to,
            $site->site_name,
            $site->tank,
            $site->tank_product,
            $site->inventory_date,
            $site->opening_stock,
            $site->deliveries,
            $site->adjustments,
            $site->sales,
            $site->closing_stock,
            $site->book_stock,
            $site->variance,
        ];
    }

    public function headings(): array
    {
        return [
            'Owner',
            'Ship To',
            'Site Name',
            'Tank',
            'Tank Product',
            'Inventory Date',
            'Opening Stock',
            'Deliveries',
            'Adjustments',
            'Sales',
            'Closing Stock',
            'Book Stock',
            'Variance',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Make row 1 (headings) bold
        ];
    }
}