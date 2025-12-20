<?php

namespace App\Services\SiteService;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\SiteService\SiteServiceInterface;
use App\Repository\SiteRepository\SiteRepositoryInterface;

class SiteService implements SiteServiceInterface
{
    protected $siteRepository;

    public function __construct(SiteRepositoryInterface $siteRepository)
    {
        $this->siteRepository = $siteRepository;
    }

    public function createSite(array $data)
    {
        DB::beginTransaction();

        try {
            if(!isset($data['id'])){
                $data['id'] =  (string) Str::uuid();
            }
            $site = $this->siteRepository->create($data);
            DB::commit();
            return $site;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    } 

    public function deleteSite($siteId)
    {
        DB::beginTransaction();

        try {
            $this->siteRepository->deleteSite($siteId);
            DB::commit();
            return true;
        }catch (Exception $e) {
        DB::rollBack();
        throw $e;
        }
    }
}