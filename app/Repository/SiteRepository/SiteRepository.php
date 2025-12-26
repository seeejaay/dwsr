<?php

namespace App\Repository\SiteRepository;

use App\Models\Site;
use Illuminate\Support\Facades\DB;
use App\Repository\BaseRepository\BaseRepository;

class SiteRepository extends BaseRepository implements SiteRepositoryInterface
{
    public function __construct(Site $model)
    {
        parent::__construct($model);
    }

    public function deleteSite($siteId)
    {
        return $this->model->where('id', $siteId)->update([
            'is_deleted' => 1,
            'is_active' => 0,
            'deleted_at' => now()
        ]);
    }

    public function getAllSiteDetailsForExport($startDate, $endDate)
{
    // Always require both dates, no fallback to all data
    if (!$startDate || !$endDate) {
        throw new \InvalidArgumentException('Start date and end date are required.');
    }
    return DB::select('SELECT * FROM get_site_details(?, ?)', [$startDate, $endDate]);
}
}