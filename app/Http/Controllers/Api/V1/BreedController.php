<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Breed\Contracts\BreedProviderInterface;

class BreedController extends Controller
{
    public function __construct(
        private BreedProviderInterface $breedProvider
    ) {}

    public function index()
    {
        $breeds = $this->breedProvider->getAll();

        return response()->json([
            'data' => $breeds
        ]);
    }
}