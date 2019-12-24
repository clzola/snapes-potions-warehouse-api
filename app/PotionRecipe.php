<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PotionRecipe
 *
 * @property int $id
 * @property int $potion_id
 * @property string $instructions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Ingredient[] $ingredients
 * @property-read int|null $ingredients_count
 * @property-read \App\Potion $potion
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipe query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipe whereInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipe wherePotionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PotionRecipe whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PotionRecipe extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'potion_recipes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'potion_id',
        'instructions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'potion_id' => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function potion()
    {
        return $this->belongsTo(Potion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'potion_recipe_ingredient')
            ->using(PotionRecipeIngredient::class)
            ->withPivot(['amount', 'measurement_unit']);
    }
}
