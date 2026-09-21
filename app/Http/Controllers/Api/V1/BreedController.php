<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListBreedsRequest;
use App\Http\Resources\BreedResource;
use App\Services\Breed\BreedCatalogService;
use App\Services\Breed\Contracts\BreedProviderInterface;

class BreedController extends Controller
{
    public function __construct(
        private BreedCatalogService $catalogService,
        private BreedProviderInterface $breedProvider
    ) {}

    public function index(ListBreedsRequest $request)
    {
        $breeds = $this->catalogService->getAll(
            $request->validated()
        );

        return BreedResource::collection($breeds);
    }

    public function show(string $id)
    {
        $breed = $this->breedProvider->findById(
            (int) $id
        );

        return new BreedResource($breed);
    }
}