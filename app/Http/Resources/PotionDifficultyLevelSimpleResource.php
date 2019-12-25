<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PotionDifficultyLevelResource
 * @package App\Http\Resources
 *
 * @mixin \App\PotionDifficultyLevel
 */
class PotionDifficultyLevelSimpleResource extends JsonResource
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
            'order' => $this->order,
        ];
    }
}
