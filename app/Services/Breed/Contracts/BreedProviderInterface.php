<?php

namespace App\Services\Breed\Contracts;

interface BreedProviderInterface
{
    public function getAll(array $params = []): array;

    public function findById(int $id): array;

    public function search(string $query): array;
}