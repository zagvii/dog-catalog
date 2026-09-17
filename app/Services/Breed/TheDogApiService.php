<?php

namespace App\Services\Breed;

use Illuminate\Support\Facades\Http;
use App\Services\Breed\Contracts\BreedProviderInterface;

class TheDogApiService implements BreedProviderInterface
{
    public function getAll(): array
    {
        $response = Http::withHeaders([
            'x-api-key' => config('services.dog_api.key'),
        ])->get(
            config('services.dog_api.url') . '/breeds'
        );

        $response->throw();

        return $response->json();
    }
}