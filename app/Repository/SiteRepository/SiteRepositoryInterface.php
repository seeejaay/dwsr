<?php

namespace App\Repository\SiteRepository;

use App\Repository\BaseRepository\BaseRepositoryInterface;

interface SiteRepositoryInterface extends BaseRepositoryInterface
{
    public function deleteSite($siteId);
    public function getAllSiteDetailsForExport($startDate, $endDate);
}