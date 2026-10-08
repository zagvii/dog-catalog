<?php

namespace App\Http\Controllers;

use App\Services\Breed\BreedCatalogService;
use App\Http\Requests\ListBreedsRequest;

class BreedCatalogController extends Controller
{
    public function __construct(
        private BreedCatalogService $catalogService
    ) {}

    public function index(ListBreedsRequest $request)
    {
        $filters = $request->validated();
        $breeds = $this->catalogService->getAll($filters);

        return view('breeds.index', [
            'breeds' => $breeds,
            'filters' => $filters
        ]);
    }
}