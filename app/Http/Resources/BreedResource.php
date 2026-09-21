<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BreedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'origin' => $this['origin'] ?? null,
            'breed_group' => $this['breed_group'] ?? null,
            'image' => $this['image']['url'] ?? null,
            'weight' => [
                'metric' => $this['weight']['metric'] ?? null,
            ],
            'height' => [
                'metric' => $this['height']['metric'] ?? null,
            ],
            'life_span' => $this['life_span'] ?? null,
            'temperament' => isset($this['temperament'])
                ? array_map(
                    'trim',
                    explode(',', $this['temperament'])
                )
                : [],
        ];
    }
}
