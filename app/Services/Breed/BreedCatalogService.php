<?php

namespace App\Services\Breed;

use App\Services\Breed\Contracts\BreedProviderInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class BreedCatalogService
{
    public function __construct(
        private BreedProviderInterface $breedProvider
    ) {}

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        if (!empty($filters['search'])) {
            $breeds = collect(
                $this->breedProvider->search(
                    trim($filters['search'])
                )
            );
        } else {
            $breeds = collect(
                $this->breedProvider->getAll([
                    'breed_groups' => $filters['breed_groups'] ?? null,
                    'order' => $filters['order'] ?? null,
                ])
            );
        }

        // Filtro por temperamento
        if (!empty($filters['temperament'])) {
            $temperament = mb_strtolower(
                trim($filters['temperament'])
            );

            $breeds = $breeds->filter(function ($breed) use ($temperament) {
                return str_contains(
                    mb_strtolower($breed['temperament'] ?? ''),
                    $temperament
                );
            });
        }

        // Filtro por origem
        if (!empty($filters['origin'])) {
            $origin = mb_strtolower(
                trim($filters['origin'])
            );

            $breeds = $breeds->filter(function ($breed) use ($origin) {
                return str_contains(
                    mb_strtolower($breed['origin'] ?? ''),
                    $origin
                );
            });
        }

        // Peso mínimo
        if (isset($filters['min_weight'])) {
            $minWeight = (float) $filters['min_weight'];

            $breeds = $breeds->filter(function ($breed) use ($minWeight) {
                $range = $this->parseWeight(
                    $breed['weight']['metric'] ?? null
                );

                return $range !== null
                    && $range['max'] >= $minWeight;
            });
        }

        // Peso máximo
        if (isset($filters['max_weight'])) {
            $maxWeight = (float) $filters['max_weight'];

            $breeds = $breeds->filter(function ($breed) use ($maxWeight) {
                $range = $this->parseWeight(
                    $breed['weight']['metric'] ?? null
                );

                return $range !== null
                    && $range['min'] <= $maxWeight;
            });
        }

        $breeds = $breeds->values();

        // Paginação
        $page = (int) ($filters['page'] ?? 1);
        $perPage = (int) ($filters['per_page'] ?? 12);

        $items = $breeds
            ->forPage($page, $perPage)
            ->values();

        return new LengthAwarePaginator(
            $items,
            $breeds->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
    }

    private function parseWeight(?string $weight): ?array
    {
        if (!$weight) {
            return null;
        }

        $parts = array_map(
            'trim',
            explode('-', $weight)
        );

        if (count($parts) !== 2) {
            return null;
        }

        return [
            'min' => (float) $parts[0],
            'max' => (float) $parts[1],
        ];
    }
}