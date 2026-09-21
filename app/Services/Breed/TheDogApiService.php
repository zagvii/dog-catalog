<?php

namespace App\Services\Breed;

use Illuminate\Support\Facades\Http;
use App\Services\Breed\Contracts\BreedProviderInterface;

class TheDogApiService implements BreedProviderInterface
{
    public function getAll(array $params = []): array
    {
        $query = [];

        if (!empty($params['breed_groups'])) {
            $query['breed_groups'] = $params['breed_groups'];
        }

        if (!empty($params['order'])) {
            $query['order'] = $params['order'];
        }

        $response = Http::withHeaders([
            'x-api-key' => config('services.dog_api.key'),
        ])->get(
            config('services.dog_api.url') . '/breeds',
            $query
        );

        $response->throw();

        return $response->json();
    }

    public function findById(int $id): array
    {
        $response = Http::withHeaders([
            'x-api-key' => config('services.dog_api.key'),
        ])->get(
            config('services.dog_api.url') . '/breeds/' . $id
        );

        $response->throw();

        return $response->json();
    }

    public function search(string $query): array
    {
        $response = Http::withHeaders([
            'x-api-key' => config('services.dog_api.key'),
        ])->get(
            config('services.dog_api.url') . '/breeds/search',
            [
                'q' => $query,
            ]
        );

        $response->throw();

        return $response->json();
    }
}