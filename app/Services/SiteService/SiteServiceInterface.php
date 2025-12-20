<?php

namespace App\Services\SiteService;

interface SiteServiceInterface
{
    public function createSite(array $data);
    public function deleteSite($siteId);
}