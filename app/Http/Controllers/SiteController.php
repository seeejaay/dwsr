<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Exports\SitesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\SiteRequest\SiteRequest;
use App\Http\Resources\SiteResource\SiteResource;
use App\Services\SiteService\SiteServiceInterface;
use App\Repository\SiteRepository\SiteRepositoryInterface;

class SiteController extends Controller {
    protected $siteService;
    protected $siteRepository;

    public function __construct(SiteServiceInterface $siteService, SiteRepositoryInterface $siteRepository) {
        $this->siteService = $siteService;
        $this->siteRepository = $siteRepository;
    }

    public function index(){
        try {
            $sites = $this->siteRepository->getAll();
            return response()->json([
                'message' => 'Sites retrieved successfully',
                'data' => SiteResource::collection($sites)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function store(SiteRequest $request){
        try {
            $site = $this->siteService->createSite($request->validated());
            return response()->json([
                'message' => 'Site created successfully',
                'data' => new SiteResource($site)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500); // Use a valid HTTP status code
        }
    }
    public function show($site){
        try {
            $site = $this->siteRepository->findById($site);
            return response()->json([
                'message' => 'Site retrieved successfully',
                'data' => new SiteResource($site)
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

    public function update(SiteRequest $request, $site){
        try {
            $site = $this->siteRepository->update($site, $request->validated());
            return response()->json([
                'message' => 'Site updated successfully',
                'data' => new SiteResource($site)
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

    public function destroy($site){
        try {
            $this->siteService->deleteSite($site);
            return response()->json([
                'message' => 'Site deleted successfully'
            ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() ?: 500;
            return response()->json([
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }

  public function export(Request $request)
    {
        try {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $sites = $this->siteRepository->getAllSiteDetailsForExport($startDate, $endDate);


            $startLabel = str_replace(' ', '', date('F Y', strtotime($startDate))); 
            $endLabel = str_replace(' ', '', date('F Y', strtotime($endDate)));     

            $fileName = "sites_export_{$startLabel}_{$endLabel}.xlsx";

            return Excel::download(new SitesExport($sites), $fileName);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}