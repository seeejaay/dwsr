<?php

namespace App\Repository\SiteRepository;

use App\Models\Site;
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
}