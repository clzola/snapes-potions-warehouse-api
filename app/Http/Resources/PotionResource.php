<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PotionResource
 * @package App\Http\Resources
 *
 * @mixin \App\Potion
 */
class PotionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'other_names' => $this->other_names,
            'potion_category_id' => $this->potion_category_id,
            'effect' => $this->effect,
            'characteristics' => $this->characteristics,
            'side_effects' => $this->side_effects,
            'brewing_time' => $this->brewing_time,
            'potion_difficulty_level_id' => $this->potion_difficulty_level_id,
            'description' => $this->description,
            'picture' => $this->picture,
            'bottles' => $this->bottles,
            'created_at' => optional($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => optional($this->updated_at)->format('Y-m-d H:i:s'),
            'potion_category' => new PotionCategoryResource($this->whenLoaded('potionCategory')),
            'potion_difficulty_level' => $this->whenLoaded('potionDifficultyLevel', function() {
                return $this->potionDifficultyLevel->only(['id', 'name']);
            }),
        ];
    }
}
