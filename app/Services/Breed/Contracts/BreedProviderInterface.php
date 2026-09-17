<?php

namespace App\Services\Breed\Contracts;

interface BreedProviderInterface
{
    public function getAll(): array;
}