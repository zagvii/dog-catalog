<?php

namespace App\Http\Controllers;

use App\Services\Breed\BreedCatalogService;

class BreedCatalogController extends Controller
{
    public function __construct(
        private BreedCatalogService $catalogService
    ) {}

    public function index()
    {
        $breeds = $this->catalogService->getAll();

        return view('breeds.index', [
            'breeds' => $breeds
        ]);
    }
}