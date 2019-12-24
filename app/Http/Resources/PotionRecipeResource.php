<?php

namespace App\Http\Resources;

use App\PotionRecipe;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PotionRecipeResource
 * @package App\Http\Resources
 *
 * @mixin \App\PotionRecipe
 */
class PotionRecipeResource extends JsonResource
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
            'potion_id' => $this->potion_id,
            'instructions' => $this->instructions,
            'created_at' => optional($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => optional($this->updated_at)->format('Y-m-d H:i:s'),
            'potion' => new PotionRecipe($this->whenLoaded('potion')),
            'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients')),
        ];
    }
}
